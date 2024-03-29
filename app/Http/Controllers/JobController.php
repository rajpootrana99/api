<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\Site;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
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
        $jobs = Task::with('quotes.estimate.subheader.header', 'site', 'user', 'entity', 'invoices')->where(['type' => 2])->get();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($job)
    {
        $job = Task::with('quotes.estimate.subheader.header', 'items', 'items.itemGalleries', 'site', 'user', 'entity', 'invoices')->find($job);
        // return response()->json([
        //     'job' => $job,
        //     'currentPath' => "explorer/".$job->entity->entity."/".$job->site->site."/".$job->title." (".$job->id.")"
        // ]);
        return view('job.show', [
            'job' => $job,
            'currentPath' => "explorer/".$job->entity->entity."/".$job->site->site."/".$job->title." (".$job->id.")"
        ]);
    }

    public function showInvoice($job){
        $invoice = Invoice::with('quotes.estimate.subHeader.header', 'entity', 'task.site', 'task.quotes.estimate.subHeader.header')->where(['task_id' => $job])->first();
        if ($invoice) {
            return view('invoice.invoice', ['invoice' => $invoice]);
        } else {
            $invoice = Invoice::latest()->first();
            if ($invoice) {
                $invoiceNo = $invoice->id + 1;
            } else {
                $invoiceNo = 1;
            }
            $job = Task::where(['id' => $job])->get();
            return view('invoice.create', ['invoiceNo' => $invoiceNo, 'job' => $job]);
        }
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
        $job = Task::find($job);

        $jobId = $job->id;
        $jobOldName = $job->title." (".$jobId.")";
        $jobNewName = $request->input("title")." (".$jobId.")";

        $job->update($request->all());


        //Change task name in all places
        $siteName = Site::find($job->site_id)->site;
        $entity = Entity::find($job->entity_id);
        $manager = new FileExplorerController();
        $entityName = $entity->entity;
        if ($entity->type == "Client") {
            $manager->saveEditedData(new Request([
                "name" => $jobNewName,
                "path" => "explorer/" . $entityName . "/" . $siteName . "/" . $jobOldName,
                "isDir" => true,
                "newParentFolderPath" => "explorer/" . $entityName . "/" . $siteName,
            ]));
        }
        //Change task name in all places
        // $siteName = Site::find($job->site_id)->site;
        // $entityName = Entity::find($job->entity_id)->entity;
        // $manager = new FileExplorerController();
        // $manager->saveEditedData(new Request([
        //     "name" => $jobNewName,
        //     "path" => "explorer/".$entityName."/".$siteName."/Tasks"."/".$jobOldName,
        //     "isDir" => true,
        //     "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Tasks",
        // ]));

        // if($job->type ==1 ){
        //     $manager->saveEditedData(new Request([
        //         "name" => $jobNewName,
        //         "path" => "explorer/".$entityName."/".$siteName."/Enquiries"."/".$jobOldName,
        //         "isDir" => true,
        //         "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Enquiries",
        //     ]));

        //     if($job->type ==2 ){
        //         $manager->saveEditedData(new Request([
        //             "name" => $jobNewName,
        //             "path" => "explorer/".$entityName."/".$siteName."/Jobs"."/".$jobOldName,
        //             "isDir" => true,
        //             "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Jobs",
        //         ]));
        //     }
        // }

        if ($job) {
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
        $enquiry_status = 0;
        if ($task->type == 'Enquiry') {
            $enquiry_status = 3;
        }
        $task->update([
            'enquiry_status' => $enquiry_status,
            'status' => 1,
            'type' => 2,
            'job_created_at' => Carbon::now(),
        ]);

        //creating folder under site's enquiry folder with the name of the task turning to enuiry
        // $jobName = $task->title;
        // $entityName = Entity::find($task->entity_id)->entity;
        // $siteName = Site::find($task->site_id)->site;
        // $manager = new FileExplorerController();
        // $manager->createJob($entityName, $siteName, $jobName);

        return redirect()->route('job.index');
    }
}
