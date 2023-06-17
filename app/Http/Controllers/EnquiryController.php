<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Site;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('enquiry.index');
    }

    public function fetchEnquiries()
    {
        $enquiries = Enquiry::with('task.quotes', 'task.site', 'task.user', 'task.entity')->get();
        return response()->json([
            'enquiries' => $enquiries,
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
        $validator = Validator::make($request->all(), [
            'task_id' => ['required', 'integer'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $task = Task::find($request->task_id);
        $task->update([
            'status' => 1,
            'is_enquiry' => 1,
        ]);
        $enauiry = Enquiry::create($request->all());
        if ($enauiry) {
            return response()->json([
                'status' => 1,
                'message' => 'Enquiry Added Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit($enquiry)
    {
        $enquiry = Enquiry::with('user', 'site')->find($enquiry);
        $sites = Site::all();
        $users = User::role('Client')->get();
        if ($enquiry) {
            return response()->json([
                'status' => true,
                'enquiry' => $enquiry,
                'sites' => $sites,
                'users' => $users,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Enquiry available against this id',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $enquiry)
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

        $enquiry = Enquiry::find($enquiry);
        $enquiry = $enquiry->update($request->all());
        if ($enquiry) {
            return response()->json([
                'status' => 1,
                'message' => 'Enquiry Updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($enquiry)
    {
        $enquiry = Enquiry::find($enquiry);
        if ($enquiry) {
            $enquiry->delete();
            return response()->json([
                'status' => true,
                'message' => 'Enquiry deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No enquiry available against this id',
            ]);
        }
    }
}
