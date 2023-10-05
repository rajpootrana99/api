<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Header;
use App\Models\Invoice;
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
        $headers = Header::with('subHeaders.estimates')->get();
        $quotes = Quote::with('task', 'estimate.subHeader.header')->where(['task_id' => $task])->orderBy('estimate_id', 'asc')->get();
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
        $invoice = Invoice::create([
            'entity_id' => $task->entity_id,
            'task_id' => $task->id,
            'issue_date' => date("Y-m-d"),
            'due_date' => $task->requested_completion,
            'amount_are' => 0,
            'sub_total' => $request->total_subtotal,
            'tax' => $request->total_tax,
            'total' => $request->total_amount_inc_gst,
            'status' => 0,
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
        if(count(Quote::where(['task_id' => $quote])->get()) > 0){
            return view('quote.edit', [
                'task' => Task::with('quotes.estimate.subHeader.header')->find($quote), 
                'estimates' => Estimate::with('subHeader.header')->get()
            ]);
        }
        else{
            return view('quote.create', ['task' => Task::with('quotes.estimate.subHeader.header')->find($quote)]);
        }
    }

    public function editInvoice($task){
        return view('job.edit', ['invoice' => Invoice::with('task.quotes.estimate.subHeader.header', 'entity')->where(['task_id' => $task])->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $task)
    {
        $validator = Validator::make($request->all(), [
            'estimate_id' => ['required'],
            'task_id' => ['required'],
        ]);

        $quotes = Quote::where(['task_id' => $task])->get();
        foreach($quotes as $quote){
            $quote->delete();
        }
        foreach ($request->quotes as $quoteData) {
            $quote = Quote::create([
                'task_id' => $task,
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
        return redirect()->route('job.index');
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

    public function captureSaving($quote){
        $quote = Quote::find($quote);
        if($quote->capture_savings == 0){
            $quote->update([
                'capture_savings' => 1,
                'movement' => $quote->amount - $quote->order_total_amount,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Capture Saving updated successfully',
            ]);
        }
        if($quote->capture_savings == 1){
            $quote->update([
                'capture_savings' => 0,
                'movement' => 0,
            ]);
        }
    }
}
