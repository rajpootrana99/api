<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Item;
use App\Models\ItemGallery;
use App\Models\Site;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function index()
    {
        return view('task.index');
    }

    public function fetchTasks()
    {
        $tasks = Task::with('user', 'site', 'items', 'items.itemGalleries')->get();
        return response()->json([
            'status' => true,
            'tasks' => $tasks,
        ]);
    }

    public function fetchUserTasks($user)
    {
        $tasks = Task::with('user', 'site', 'items', 'items.itemGalleries')->where('user_id', $user)->get();
        return response()->json([
            'status' => true,
            'tasks' => $tasks,
        ]);
    }

    public function fetchItemGalleries($item)
    {
        $item = Item::with('itemGalleries')->where('id', $item)->first();
        return response()->json([
            'status' => true,
            'item' => $item,
        ]);
    }

    public function show($task)
    {
        $task = Task::with('user', 'site', 'items', 'items.itemGalleries')->where('id', $task)->first();
        if ($task) {
            return response()->json([
                'status' => 200,
                'task' => $task
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Task not found'
            ]);
        }
    }

    public function create()
    {
        return view('task.create');
    }

    public function destroy($task)
    {
        $task = Task::find($task);
        if ($task) {
            $entity = Entity::find($task->entity_id);
            $siteName = Site::find($task->site_id)->site;
            $taskName = $task->title;

            $task->items()->delete();
            $task->delete();

            if($entity->type == "Client"){
                $taskPath = "explorer/".$entity->entity."/Sites/".$siteName."/Tasks/".$taskName;
                $manager = new FileExplorerController();
                $manager->deleteFileFolder(new Request(["file" => base64_encode($taskPath)]));
            }
            return response()->json([
                'status' => 200,
                'message' => 'Task Deleted Successfully'
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Task not found'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => ['required'],
            'title' => ['required', 'unique:tasks,title,NULL,id,site_id,' . $request->input('site_id') . ',entity_id,' . $request->input('entity_id')],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }


        $task = Task::create($request->all());

        foreach ($request->items as $itemData) {
            $item = Item::create([
                'task_id' => $task->id,
                'description' => $itemData['description'],
                'priority' => $itemData['priority'],
                'progress' => $itemData['progress'],
            ]);
            if ($itemData['image']) {
                foreach ($itemData['image'] as $image) {
                    $itemGallery = new ItemGallery();
                    $destinationPath = 'item_images/';
                    $filename = $image->getClientOriginalName();
                    $image->move($destinationPath, $filename);
                    $fullPath = $destinationPath . $filename;
                    $itemGallery->item_id = $item->id;
                    $itemGallery->image = $fullPath;
                    $itemGallery->save();
                }
            }
        }

        //directory with task name in respected entity
        $taskName = $request->input('title');
        $entity = Entity::find($request->input('entity_id'));
        $siteName = Site::find($request->input('site_id'))->site;
        $manager = new FileExplorerController();
        if( $entity->type == "Client" ){
            $entityName = $entity->entity;
            $manager->createTask($entityName, $siteName, $taskName);
        }


        return redirect()->route('task.index');
    }

    public function edit($task)
    {
        $task = Task::find($task);
        return response()->json([
            'status' => true,
            'task' => $task,
        ]);
    }

    public function update(Request $request, $task)
    {
        $task= Task::find($task);

        $taskOldName = $task->title;
        $taskNewName = $request->input("title");

        $task->update($request->all());



        if($task){

            //Change task name in all places
            $siteName = Site::find($task->site_id)->site;
            $entity = Entity::find($task->entity_id);
            $manager = new FileExplorerController();
            $entityName = $entity->entity;
            if( $entity->type == "Client" ){
                $manager->saveEditedData(new Request([
                    "name" => $taskNewName,
                    "path" => "explorer/".$entityName."/Sites"."/".$siteName."/Tasks"."/".$taskOldName,
                    "isDir" => true,
                    "newParentFolderPath" => "explorer/".$entityName."/Sites"."/".$siteName."/Tasks",
                ]));
            }


            return response()->json([
                'status' => true,
                'message' => 'Task updated succesfully'
            ]);
        }
    }
}
