<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Header;
use App\Models\SubHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimate.index');
    }

    public function fetchEstimates()
    {
        $estimates = Estimate::with('subHeader.header')->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'estimates' => $estimates,
        ]);
    }

    public function fetchHeaders()
    {
        $headers = Header::with('subHeaders.estimates')->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'headers' => $headers,
        ]);
    }

    public function fetchSubHeaders($header)
    {
        $subHeaders = SubHeader::where(['header_id' => $header])->get();
        return response()->json([
            'status' => true,
            'subHeaders' => $subHeaders,
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
            'sub_header_id' => ['required'],
            'item' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $estimate = Estimate::create($request->all());
        if ($estimate) {
            return response()->json(['status' => 1, 'message' => 'Estimate Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function edit($estimate)
    {
        $estimate = Estimate::find($estimate);
        if ($estimate) {
            return response()->json([
                'status' => true,
                'estimate' => $estimate,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Estimate not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $estimate)
    {
        $validator = Validator::make($request->all(), [
            'header' => ['required'],
            'major_code' => ['required'],
            'cost_code' => ['required'],
            'sub_header' => ['required'],
            'item' => ['required'],
            'label' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $estimate = Estimate::find($estimate);
        $estimate->update($request->all());
        if ($estimate) {
            return response()->json(['status' => 1, 'message' => 'Estimate Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        //
    }

    public function addSubHeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'header_id' => ['required'],
            'sub_header' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $subHeader = SubHeader::create($request->all());
        if ($subHeader) {
            return response()->json([
                'status' => 1,
                'message' => 'Sub Header Added Successfully'
            ]);
        }
    }
}
