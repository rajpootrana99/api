<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site_user.index');
    }

    public function fetchSiteUsers()
    {
        $user_sites = User::with('sites')->where(['is_admin' => 0])->get();
        return response()->json([
            'status' => true,
            'user_sites' => $user_sites,
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
        $validator = Validator::make($request->all(), [
            'site_id' => ['required'],
            'user_id' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $users = User::find($request->user_id);
        // return response()->json($user);
        for ($count = 0; $count < count($users); $count++) {
            $users[$count]->sites()->sync($request->site_id);
        }
        if ($users) {
            return response()->json(['status' => 1, 'message' => 'Site against User Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $users = User::where(['is_admin' => 0])->get();
        $sites = Site::all();
        $site_user = User::with('sites')->where('id', $user)->first();
        if ($site_user) {
            return response()->json([
                'status' => 200,
                'site_user' => $site_user,
                'sites' => $sites,
                'users' => $users,
            ]);
        } else {
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
    public function update(Request $request, $user)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => ['required'],
            'user_id' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $user = User::find($user);
        $user->sites()->detach();
        // $site->users()->attach($request->user_id);
        $users = User::find($request->user_id);
        // return response()->json($user);
        for ($count = 0; $count < count($users); $count++) {
            $users[$count]->sites()->sync($request->site_id);
        }
        if ($users) {
            return response()->json(['status' => 1, 'message' => 'Site against User updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        $user->sites()->detach();
        if ($user) {
            return response()->json(['status' => 1, 'message' => 'Site against User deleted Successfully']);
        }
    }
}
