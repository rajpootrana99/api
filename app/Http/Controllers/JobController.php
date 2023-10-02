<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\Site;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job.index');
    }

    public function fetchJobs()
    {
        $jobs = Task::with('contact.user', 'quotes.estimate.subheader.header', 'site', 'user', 'entity')->where(['type' => 2])->get();
        return response()->json([
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'site_id' => ['required', 'integer'],
        //     'description' => ['required', 'string', 'min:3'],
        // ]);
        // if (!$validator->passes()) {
        //     return response()->json([
        //         'status' => 0,
        //         'error' => $validator->errors()->toArray()
        //     ]);
        // }

        // $job = Job::create($request->all());
        // if ($job) {
        //     return response()->json([
        //         'status' => 1,
        //         'message' => 'Job Added Successfully'
        //     ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($job)
    {
        $invoice = Invoice::with('entity', 'task.site', 'task.quotes.estimate.subHeader.header')->where(['task_id' => $job])->first();
        return view('job.invoice', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($job)
    {
        $task = Task::find($job);
        return response()->json([
            'status' => true,
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $job)
    {
        $job= Task::find($job);

        $jobOldName = $job->title;
        $jobNewName = $request->input("title");

        $job->update($request->all());

        //Change task name in all places
        $siteName = Site::find($job->site_id)->site;
        $entityName = Entity::find($job->entity_id)->entity;
        $manager = new FileExplorerController();
        $manager->saveEditedData(new Request([
            "name" => $jobNewName,
            "path" => "explorer/".$entityName."/".$siteName."/Tasks"."/".$jobOldName,
            "isDir" => true,
            "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Tasks",
        ]));

        if($job->type ==1 ){
            $manager->saveEditedData(new Request([
                "name" => $jobNewName,
                "path" => "explorer/".$entityName."/".$siteName."/Enquiries"."/".$jobOldName,
                "isDir" => true,
                "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Enquiries",
            ]));

            if($job->type ==2 ){
                $manager->saveEditedData(new Request([
                    "name" => $jobNewName,
                    "path" => "explorer/".$entityName."/".$siteName."/Jobs"."/".$jobOldName,
                    "isDir" => true,
                    "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Jobs",
                ]));
            }
        }

        if($job){
            return response()->json([
                'status' => true,
                'message' => 'Job updated succesfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($job)
    {
        $job = Job::find($job);
        if ($job) {
            $job->delete();
            return response()->json([
                'status' => true,
                'message' => 'Job deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No job available against this id',
            ]);
        }
    }

    public function convertToJob($task)
    {
        $task = Task::find($task);
        $task->update([
            'status' => 1,
            'type' => 2,
        ]);

        //creating folder under site's enquiry folder with the name of the task turning to enuiry
        $jobName = $task->title;
        $entityName = Entity::find($task->entity_id)->entity;
        $siteName = Site::find($task->site_id)->site;
        $manager = new FileExplorerController();
        $manager->createJob($entityName, $siteName, $jobName);

        return redirect()->route('job.index');
    }
}
