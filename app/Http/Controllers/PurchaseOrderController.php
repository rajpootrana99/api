<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderGallery;
use App\Models\Quote;
use App\Models\Site;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchaseOrder.index');
    }

    public function fetchPurchaseOrders()
    {
        $purchaseOrders = PurchaseOrder::with('entity', 'task.site')->get();
        return response()->json([
            'status' => true,
            'purchaseOrders' => $purchaseOrders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchaseOrder = PurchaseOrder::latest()->first();
        if ($purchaseOrder) {
            $purchaseNo = $purchaseOrder->id + 1;
        } else {
            $purchaseNo = 1;
        }
        return view('purchaseOrder.create', ['purchaseNo' => $purchaseNo]);
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
        $purchaseOrder = PurchaseOrder::create($request->all());

        foreach ($request->items as $itemData) {
            if ($itemData['description'] != null) {
                $quote = Quote::find($itemData['quote_id']);
                $purchaseOrder->quotes()->attach($quote, [
                    'description' => $itemData['description'],
                    'qty' => $itemData['qty'],
                    'rate' => $itemData['order_unit_price'],
                    'amount' => $itemData['order_total_amount'],
                    'tax' => $itemData['tax'],
                    'total' => $itemData['order_total_amount'] + (($itemData['order_total_amount'] / 100) * $itemData['tax'])
                ]);
                if ($quote) {
                    $quote->update([
                        'order_unit_price' => $itemData['order_unit_price'],
                        'order_total_amount' => $itemData['order_total_amount'],
                    ]);
                }
            }
        }

        $task = Task::find($purchaseOrder->task_id);
        $taskName = $task->title . " (" . $task->id . ")";
        $entityName = Entity::find($task->entity_id)->entity;
        $siteName = Site::find($task->site_id)->site;

        if ($request->image) {
            foreach ($request->image as $image) {
                $purchaseOrderGallery = new PurchaseOrderGallery();
                $purchaseOrderAbsolutePath = storage_path("app/explorer/$entityName/$siteName/$taskName/Orders/");
                $filename = $image->getClientOriginalName();
                $image->move($purchaseOrderAbsolutePath, $filename);
                $fullPath = "explorer/$entityName/$siteName/$taskName/Images/" . $filename;
                $purchaseOrderGallery->purchase_order_id = $purchaseOrder->id;
                $purchaseOrderGallery->image = $fullPath;
                $purchaseOrderGallery->save();
            }
        }

        return redirect()->route('purchaseOrder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show($purchaseOrder)
    {
        $purchaseOrder = PurchaseOrder::with('quotes.estimate.subHeader.header', 'entity', 'task.site', 'task.quotes.estimate.subHeader.header', 'task.entity')->find($purchaseOrder);
        return view('purchaseOrder.purchaseOrder', ['purchaseOrder' => $purchaseOrder]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($purchaseOrder)
    {
        $purchaseOrder = PurchaseOrder::with('quotes.estimate.subheader.header', 'task.quotes')->find($purchaseOrder);
        $jobs = Task::with('quotes.estimate.subheader.header', 'site', 'user', 'entity')->where(['type' => 2])->get();
        return view('purchaseOrder.edit', ['purchaseOrder' => $purchaseOrder, 'jobs' => $jobs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $purchaseOrder)
    {
        $validator = Validator::make($request->all(), [
            'entity_id' => ['required'],
            'task_id' => ['required'],
        ]);
        $purchaseOrder = PurchaseOrder::find($purchaseOrder);
        $purchaseOrder->update($request->all());

        foreach ($request->items as $itemData) {
            if ($itemData['description'] != null) {
                $quote = Quote::find($itemData['quote_id']);
                if ($purchaseOrder->quotes->contains($itemData['quote_id'])) {
                    $purchaseOrder->quotes()->updateExistingPivot($itemData['quote_id'], [
                        'description' => $itemData['description'],
                        'qty' => $itemData['qty'],
                        'rate' => $itemData['order_unit_price'],
                        'amount' => $itemData['order_total_amount'],
                        'tax' => $itemData['tax'],
                        'total' => $itemData['order_total_amount'] + (($itemData['order_total_amount'] / 100) * $itemData['tax'])
                    ]);
                } else {
                    if ($itemData['description']) {
                        $purchaseOrder->quotes()->attach($itemData['quote_id'], [
                            'description' => $itemData['description'],
                            'qty' => $itemData['qty'],
                            'rate' => $itemData['order_unit_price'],
                            'amount' => $itemData['order_total_amount'],
                            'tax' => $itemData['tax'],
                            'total' => $itemData['order_total_amount'] + (($itemData['order_total_amount'] / 100) * $itemData['tax'])
                        ]);
                    }
                }
                if ($quote) {
                    $quote->update([
                        'order_unit_price' => $itemData['order_unit_price'],
                        'order_total_amount' => $itemData['order_total_amount'],
                    ]);
                }
            }
        }
        return redirect()->route('purchaseOrder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    public function add(Request $request)
    {
        $purchaseOrder = PurchaseOrder::latest()->first();
        if ($purchaseOrder) {
            $purchaseNo = $purchaseOrder->id + 1;
        } else {
            $purchaseNo = 1;
        }
        $jobs = Task::with('quotes.estimate.subheader.header', 'site', 'user', 'entity')->where(['type' => 2])->get();
        $quotes = Quote::with('task')->whereIn('id', $request->quote_id)->get();
        return view('purchaseOrder.add', ['quotes' => $quotes, 'purchaseNo' => $purchaseNo, 'jobs' => $jobs]);
    }
}
