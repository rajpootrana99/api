<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Header;
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

    public function fetchQuotes($task)
    {
        $headers = Header::with('subHeaders.estimates')->orderBy('id', 'desc')->get();
        $quotes = Quote::with('task', 'estimate.subHeader.header')->where(['task_id' => $task])->get();
        return response()->json([
            'status' => true,
            'quotes' => $quotes,
            'headers' => $headers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'task_id' => ['required'],
        ]);
        $task = Task::find($request->task_id);
        $task->update([
            'is_quote' => 1,
        ]);
        foreach ($request->quotes as $quoteData) {
            $quote = Quote::create([
                'task_id' => $request->task_id,
                'description' => $quoteData['description'],
                'estimate_id' => $quoteData['estimate_id'],
                'unit' => $quoteData['unit'],
                'qty' => $quoteData['qty'],
                'rate' => $quoteData['rate'],
                'amount' => $quoteData['amount'],
                'margin' => $quoteData['margin'],
                'subtotal' => $quoteData['subtotal'],
                'gst' => 10,
                'amount_inc_gst' => $quoteData['amount_inc_gst'],
                'quote_complete' => $quoteData['quote_complete'] ?? ' ',
            ]);
        }

        return view('enquiry.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show($quote)
    {
        $task = Task::with('site')->find($quote);
        return view('quote.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit($quote)
    {
        return view('quote.create', ['task' => Task::with('quotes.estimate.subHeader.header')->find($quote)]);
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
