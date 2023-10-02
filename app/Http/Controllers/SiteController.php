<?php

namespace App\Http\Controllers;

use App\Models\Entity;
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

    public function fetchSites()
    {
        $sites = Site::with('users', 'entity')->get();
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
            'site' => ['required', 'string', 'min:3'],
            'site_address' => ['required', 'string', 'min:3'],
            'entity_id' => ['required'],
            'suburb' => ['required'],
            'state' => ['required'],
            'post_code' => ['required'],
            'active' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $site = Site::create($request->all());
        $user = User::where('email', "info@insitebg.com.au")->first();
        if ($user) {
            $user->sites()->sync($site, false);
        }

        if ($site) {
            //creating site folder under the entity folder in explorer directory
            $entityName = Entity::find($request->input('entity_id'))->entity;
            $manager = new FileExplorerController();
            $manager->createSite($entityName, $request->input('site'));

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
        $entities = Entity::all();
        $site = Site::with('users')->where('id', $site)->first();
        if ($site) {
            return response()->json([
                'status' => 200,
                'site' => $site,
                'entities' => $entities,
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
    public function update(Request $request, $site)
    {
        $validator = Validator::make($request->all(), [
            'site' => ['required', 'string', 'min:3'],
            'site_address' => ['required', 'string', 'min:3'],
            'suburb' => ['required'],
            'state' => ['required'],
            'post_code' => ['required'],
            'active' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $site = Site::find($site);

        //Change site name also under the entity name
        $siteOldName = $site->site;
        $siteNewName = $request->input("site");
        $entityName = Entity::find($site->entity_id)->entity;
        $manager = new FileExplorerController();
        $manager->saveEditedData(new Request([
            "name" => $siteNewName,
            "path" => "explorer/".$entityName."/".$siteOldName,
            "isDir" => true,
            "newParentFolderPath" => "explorer/".$entityName,
        ]));

        $site->update($request->all());
        if ($site) {
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
        $site->users()->detach();
        $site->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Site deleted successfully',
        ]);
    }
}
