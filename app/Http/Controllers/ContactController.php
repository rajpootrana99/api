<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index');
    }

    public function fetchContacts()
    {
        $contacts = Contact::with('site', 'user')->get();
        if (count($contacts) > 0) {
            return response()->json([
                'status' => true,
                'contacts' => $contacts,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Contacts are available yet',
            ]);
        }
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
            'site_id' => ['required', 'integer'],
            'fname' => ['required', 'string', 'min:3'],
            'lname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'min:3'],
            'phone' => ['required'],
            'employer' => ['required', 'string', 'min:3'],
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
        ]);
        $user->assignRole('Contact');
        $contact = Contact::create([
            'emp_id' => $request->emp_id,
            'site_id' => $request->site_id,
            'user_id' => $user->id,
            'employer' => $request->employer,
            'role' => $request->role,
            'active' => $request->active,
        ]);
        if ($contact) {
            return response()->json([
                'status' => 1,
                'message' => 'Contact Added Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($contact)
    {
        $contact = Contact::with('user')->find($contact);
        $sites = Site::all();
        if ($contact) {
            return response()->json([
                'status' => true,
                'contact' => $contact,
                'sites' => $sites,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No contact available against this id',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contact)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => ['required', 'integer'],
            'fname' => ['required', 'string', 'min:3'],
            'lname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'min:3'],
            'phone' => ['required'],
            'employer' => ['required', 'string', 'min:3'],
            'role' => ['required', 'string', 'min:3'],
            'active' => ['required', 'integer'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $contact = Contact::find($contact);
        $user = User::find($contact->user_id);
        $user->update([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        $contact->update($request->all());
        if ($contact) {
            return response()->json([
                'status' => 1,
                'message' => 'Contact Updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact)
    {
        $contact = Contact::find($contact);
        if ($contact) {
            $user = User::find($contact->user_id);
            $contact->delete();
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Contact deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No contact available against this id',
            ]);
        }
    }
}
