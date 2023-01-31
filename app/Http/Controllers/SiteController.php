<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.index');
    }

    public function fetchSites(){
        $sites = Site::with('user')->get();
        return response()->json([
            'status' => true,
            'sites' => $sites,
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
            'user_id' => ['required'],
            'site' => ['required', 'string', 'min:3']
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $site = Site::create([
            'user_id' => $request->input('user_id'),
            'site' => $request->input('site'),
        ]);
        if ($site){
            return response()->json(['status' => 1, 'message' => 'Site Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show($site)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit($site)
    {
        $site = Site::with('user')->where('id', $site)->first();
        $users = User::where(['is_admin' => 0])->get();
        if ($site){
            return response()->json([
                'status' => 200,
                'site' => $site,
                'users' => $users,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Site not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $site)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'site' => ['required', 'string', 'min:3']
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $site = Site::find($site);
        $site->update($request->all());
        if ($site){
            return response()->json(['status' => 1, 'message' => 'Site Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $site->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Site deleted successfully',
        ]);
    }
}
