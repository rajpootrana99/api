<?php

namespace App\Http\Controllers;

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
    public function edit($task)
    {
        $task = Task::find($task);
        $task->update([
            'status' => 1,
            'type' => 2,
        ]);
        return redirect()->route('job.index');
        
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
        $validator = Validator::make($request->all(), [
            'site_id' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:3'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $job = Job::find($job);
        $job = $job->update($request->all());
        if ($job) {
            return response()->json([
                'status' => 1,
                'message' => 'Job Updated Successfully'
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
}
