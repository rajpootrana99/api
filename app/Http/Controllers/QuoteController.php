<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quote.index');
    }

    public function fetchQuotes(){
        $quotes = Quote::with('task')->get();
        return response()->json([
            'status' => true,
            'quotes' => $quotes,
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
            'qty' => ['required'],
            'rate' => ['required'],
            'margin' => ['required'],
            'gst' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $quote = Quote::create($request->all());
        if ($quote) {
            return response()->json([
                'status' => 1,
                'message' => 'Quote Added Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show($quote)
    {
        return view('quote.create', ['task' => Task::find($quote)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit($quote)
    {
        $tasks = Task::all();
        $quote = Quote::with('task')->find($quote);
        if ($quote) {
            return response()->json([
                'status' => true,
                'quote' => $quote,
                'tasks' => $tasks,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No quote available against this id',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quote)
    {
        $validator = Validator::make($request->all(), [
            'task_id' => ['required'],
            'qty' => ['required'],
            'rate' => ['required'],
            'margin' => ['required'],
            'gst' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $quote = Quote::find($quote);
        $quote = $quote->update($request->all());
        if ($quote) {
            return response()->json([
                'status' => 1,
                'message' => 'Quote Updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
