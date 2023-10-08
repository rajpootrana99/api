<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function fetchUsers()
    {
        $users = User::role(['Supplier', 'Client'])->get();
        return response()->json([
            'users' => $users,
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
            'fname' => ['required', 'string', 'min:3'],
            'lname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'min:3'],
            'phone' => ['required'],
            'entity_id' => ['required'],
            'role' => ['required', 'string', 'min:3'],
            'active' => ['required', 'integer'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $user = User::create([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('password'),
            'entity_id' => $request->entity_id,
            'role' => $request->role,
            'is_approved' => $request->active,
        ]);
        $entity = Entity::find($request->entity_id);
        if($entity->type == 0){
            $user->assignRole('Client');
        }
        else{
            $user->assignRole('Supplier');
        }
        if ($user) {
            return response()->json([
                'status' => 1,
                'message' => 'Contact Added Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::with('sites')->where('id', $user)->first();
        if ($user) {
            return response()->json([
                'status' => 200,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::find($user);
        $sites = Site::all();
        $entities = Entity::all();
        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
                'sites' => $sites,
                'entities' => $entities,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No user available against this id',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'min:3'],
            'lname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'min:3'],
            'phone' => ['required'],
            'entity_id' => ['required'],
            'role' => ['required', 'string', 'min:3'],
            'active' => ['required', 'integer'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $user = User::find($user);
        $user->update([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'entity_id' => $request->entity_id,
            'role' => $request->role,
            'is_approved' => $request->active,
        ]);
        $entity = Entity::find($request->entity_id);
        if($entity->type == 0){
            $user->assignRole('Client');
        }
        else{
            $user->assignRole('Supplier');
        }
        if ($user) {
            return response()->json([
                'status' => 1,
                'message' => 'User Updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->sites()->detach();
        $user->delete();
        return response()->json([
            'status' => 1,
            'message' => 'User deleted successfully',
        ]);
    }

    public function approveUser($user)
    {
        $user = User::find($user);
        if ($user->is_approved == 'Not Approved') {
            $value = 1;
        } else {
            $value = 0;
        }
        $user->update([
            'is_approved' => $value,
        ]);
        if ($user) {
            return response()->json([
                'status' => 1,
                'message' => 'Status changed successfully',
            ]);
        }
    }
}
