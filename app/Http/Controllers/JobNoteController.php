<?php

namespace App\Http\Controllers;

use App\Models\JobNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function fetchJobNotes(){
        $jobNotes = JobNote::orderBy('created_at', 'desc')->get();;
        return response()->json([
            'status' => 'true',
            'jobNotes' => $jobNotes,
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
            'task_id' => ['required'],
            'description' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        if ($request->hasFile('image_url')) {
            $jobNote = new JobNote();
            $destinationPath = 'jobNotes/';
            $filename = time() . '.' . $request->image_url->extension();
            $request->image_url->move($destinationPath, $filename);
            $fullPath = $destinationPath . $filename;
            $jobNote->task_id = $request->task_id;
            $jobNote->description = $request->description;
            $jobNote->image_url = $fullPath;
            $jobNote->save();
        }

        else{
            $jobNote = JobNote::create($request->all());
        }

        return response()->json([
            'status' => true,
            'message' => 'Note added successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobNote  $jobNote
     * @return \Illuminate\Http\Response
     */
    public function show(JobNote $jobNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobNote  $jobNote
     * @return \Illuminate\Http\Response
     */
    public function edit(JobNote $jobNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobNote  $jobNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobNote $jobNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobNote  $jobNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobNote $jobNote)
    {
        //
    }
}
