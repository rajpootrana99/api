<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use App\Models\Quote;
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

    public function fetchPurchaseOrders(){
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
        if($purchaseOrder){
            $purchaseNo = $purchaseOrder->id + 1;
        }
        else{
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
            $quote = Quote::find($itemData['quote_id']);
            $quote->update([
                'description' => $itemData['description'],
                'qty' => $itemData['qty'],
                'unit_price' => $itemData['unit_price'],
                'amount' => $itemData['amount'],
            ]);
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
        $purchaseOrder = PurchaseOrder::with('entity', 'task.site', 'purchaseItems.estimate.subHeader.header', 'task.entity')->find($purchaseOrder);
        return view('purchaseOrder.invoice', ['purchaseOrder' => $purchaseOrder]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
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
}
