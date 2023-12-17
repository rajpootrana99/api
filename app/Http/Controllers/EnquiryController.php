<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Entity;
use App\Models\Site;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('enquiry.index');
    }

    public function fetchEnquiries()
    {
        $enquiries = Task::with('quotes.estimate.subheader.header', 'site', 'user', 'entity')->where(['type' => 1])->orWhere(['is_enquiry' => 1])->get();
        return response()->json([
            'enquiries' => $enquiries,
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show($enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit($enquiry)
    {
        $task = Task::find($enquiry);
        return response()->json([
            'status' => true,
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $enquiry)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'unique:tasks,title,NULL,id,site_id,' . $request->input('site_id') . ',entity_id,' . $request->input('entity_id')],
            'requested_completion' => ['required'],
            'enquiry_status' => ['required'],
            'quote_type' => ['required'],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $enquiry = Task::find($enquiry);

        $enquiryId = $enquiry->id;
        $enquiryOldName = $enquiry->title." (".$enquiryId.")";
        $enquiryNewName = $request->input("title")." (".$enquiryId.")";

        $enquiry->update($request->all());

        if ($enquiry) {

            //Change task name in all places
            $siteName = Site::find($enquiry->site_id)->site;
            $entity = Entity::find($enquiry->entity_id);
            $manager = new FileExplorerController();
            $entityName = $entity->entity;
            if ($entity->type == "Client") {
                $manager->saveEditedData(new Request([
                    "name" => $enquiryNewName,
                    "path" => "explorer/" . $entityName . "/" . $siteName . "/" . $enquiryOldName,
                    "isDir" => true,
                    "newParentFolderPath" => "explorer/" . $entityName . "/" . $siteName,
                ]));
            }
        }
        //Change task name in all places
        // $siteName = Site::find($enquiry->site_id)->site;
        // $entityName = Entity::find($enquiry->entity_id)->entity;
        // $manager = new FileExplorerController();
        // $manager->saveEditedData(new Request([
        //     "name" => $enquiryNewName,
        //     "path" => "explorer/".$entityName."/".$siteName."/Tasks"."/".$enquiryOldName,
        //     "isDir" => true,
        //     "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Tasks",
        // ]));

        // if($enquiry->type >= 1 ){
        //     $manager->saveEditedData(new Request([
        //         "name" => $enquiryNewName,
        //         "path" => "explorer/".$entityName."/".$siteName."/Enquiries"."/".$enquiryOldName,
        //         "isDir" => true,
        //         "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Enquiries",
        //     ]));

        //     if($enquiry->type >= 2 ){
        //         $manager->saveEditedData(new Request([
        //             "name" => $enquiryNewName,
        //             "path" => "explorer/".$entityName."/".$siteName."/Jobs"."/".$enquiryOldName,
        //             "isDir" => true,
        //             "newParentFolderPath" => "explorer/".$entityName."/".$siteName."/Jobs",
        //         ]));
        //     }
        // }

        if($enquiry){
            return response()->json([
                'status' => true,
                'message' => 'Enquiry updated succesfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($enquiry)
    {

    }

    public function convertToEnquiry($task)
    {
        $task = Task::find($task);
        $task->update([
            'is_enquiry' => 1,
            'status' => 1,
            'type' => 1,
        ]);

        //creating folder under site's enquiry folder with the name of the task turning to enuiry
        // $enquiryName = $task->title;
        // $entityName = Entity::find($task->entity_id)->entity;
        // $siteName = Site::find($task->site_id)->site;
        // $manager = new FileExplorerController();
        // $manager->createEnquiry($entityName, $siteName, $enquiryName);

        return redirect()->route('enquiry.index');
    }
}
