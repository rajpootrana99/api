<?php

namespace App\Http\Controllers;

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
        $jobs = Task::with('quotes', 'site', 'user', 'entity')->where(['is_job' => 1])->get();
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
        $job = Task::with('entity', 'site', 'quotes.estimate.subHeader.header', 'entity')->find($job);
        return view('job.invoice', ['job' => $job]);
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
            'is_job' => 1,
            'is_enquiry' => 0,
        ]);
        return redirect()->route('job.index');
        // $job = Job::with('user', 'site')->find($job);
        // $sites = Site::all();
        // $users = User::role('Supplier')->get();
        // if ($job) {
        //     return response()->json([
        //         'status' => true,
        //         'job' => $job,
        //         'sites' => $sites,
        //         'users' => $users,
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'No job available against this id',
        //     ]);
        // }
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
