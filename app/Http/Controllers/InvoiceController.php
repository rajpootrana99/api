<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Quote;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoice.index');
    }

    public function fetchInvoices(){
        $invoices = Invoice::with('entity', 'task.site')->get();
        return response()->json([
            'status' => true,
            'invoices' => $invoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = Invoice::latest()->first();
        if($invoice){
            $invoiceNo = $invoice->id + 1;
        }
        else{
            $invoiceNo = 1;
        }
        return view('invoice.create', ['invoiceNo' => $invoiceNo]);
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
            'entity_id' => ['required'],
            'task_id' => ['required'],
        ]);
        $invoice = Invoice::create($request->all());

        foreach ($request->items as $itemData) {
            $quote = Quote::find($itemData['quote_id']);
            $invoice->quotes()->attach($quote, [
                'description' => $itemData['description'],
                'account' => $itemData['account'],
                'qty' => $itemData['qty'],
                'rate' => $itemData['rate'],
                'amount' => $itemData['amount'],
                'tax' => $itemData['tax'],
                'total' => $itemData['total']
            ]);               
        }
        return redirect()->route('invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        $invoice = Invoice::with('quotes.estimate.subHeader.header', 'entity', 'task.site', 'task.quotes.estimate.subHeader.header')->find($invoice);
        return view('invoice.invoice', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($invoice)
    {
        $invoice = Invoice::with('quotes.estimate.subheader.header', 'task.quotes' , 'entity')->find($invoice);
        $jobs = Task::with('contact.user', 'quotes.estimate.subheader.header', 'site', 'user', 'entity')->where(['type' => 2])->get();
        return view('invoice.edit', ['invoice' => $invoice, 'jobs' => $jobs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $invoice)
    {
        $validator = Validator::make($request->all(), [
            'entity_id' => ['required'],
            'task_id' => ['required'],
        ]);
        $invoice = Invoice::find($invoice);
        $invoice->update($request->all());

        foreach ($request->items as $itemData) {
            $quote = Quote::find($itemData['quote_id']);
            if($invoice->quotes->contains($itemData['quote_id'])){
                $invoice->quotes()->updateExistingPivot($itemData['quote_id'], [
                    'description' => $itemData['description'],
                    'account' => $itemData['account'],
                    'qty' => $itemData['qty'],
                    'rate' => $itemData['rate'],
                    'amount' => $itemData['amount'],
                    'tax' => $itemData['tax'],
                    'total' => $itemData['total']
                ]);
            }
            else {
                if($itemData['description']){
                    $invoice->quotes()->attach($itemData['quote_id'], [
                        'description' => $itemData['description'],
                        'account' => $itemData['account'],
                        'qty' => $itemData['qty'],
                        'rate' => $itemData['rate'],
                        'amount' => $itemData['amount'],
                        'tax' => $itemData['tax'],
                        'total' => $itemData['total']
                    ]);
                }               
            }            
        }
        return redirect()->route('invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
