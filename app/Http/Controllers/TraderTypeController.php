<?php

namespace App\Http\Controllers;

use App\Models\TradeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TraderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tradeTypes.index');
    }

    public function fetchTradeTypes(){
        $tradeTypes = TradeType::all();
        return response()->json([
            'status' => true,
            'tradeTypes' => $tradeTypes
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
            'name' => ['required', 'string'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $tradeType = TradeType::create($request->all());
        if($tradeType){
            return response()->json([
                'status' => true,
                'message' => 'Trade Type added successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TradeType  $tradeType
     * @return \Illuminate\Http\Response
     */
    public function show(TradeType $tradeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TradeType  $tradeType
     * @return \Illuminate\Http\Response
     */
    public function edit($tradeType)
    {
        $tradeType = TradeType::find($tradeType);
        return response()->json([
            'status' => true,
            'tradeType' => $tradeType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TradeType  $tradeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tradeType)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $tradeType = TradeType::find($tradeType);
        $tradeType->update($request->all());
        if($tradeType){
            return response()->json([
                'status' => true,
                'message' => 'Trade Type Updated successfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TradeType  $tradeType
     * @return \Illuminate\Http\Response
     */
    public function destroy($tradeType)
    {
        $tradeType = TradeType::find($tradeType);
        if($tradeType){
            $tradeType->delete();
            return response()->json([
                'status' => true,
                'message' => 'Trade Type deleted successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'Trade Type doesnot exist',
            ]);
        }
    }
}
