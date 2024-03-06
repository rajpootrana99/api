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

    public function fetchItemGalleries(Request $request, $item)
    {
        $item = Item::with('itemGalleries')->where('id', $item)->first();
        // $correct = array();
        // foreach ($item as $item) {
        //     // print_r($item);
        //     array_push($correct, FileExplorerController::getFileLink($request->getHttpHost(), $item->image));
        // }
        return response()->json([
            'status' => true,
            'item' => $item,
            // 'correct' => $correct,
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

            if ($entity->type == "Client") {
                $taskPath = "explorer/" . $entity->entity . "/Sites/" . $siteName . "/Tasks/" . $taskName;
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
            'title' => ['required'],
            // 'title' => ['required', 'unique:tasks,title,NULL,id,site_id,' . $request->input('site_id') . ',entity_id,' . $request->input('entity_id')],
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $task = Task::create($request->all());

        $taskName = $request->input('title') . " (" . $task->id . ")";
        $entity = Entity::find($request->input('entity_id'));
        $siteName = Site::find($request->input('site_id'))->site;
        $manager = new FileExplorerController();
        if ($entity->type == "Client") {
            $entityName = $entity->entity;
            $manager->createTask($entityName, $siteName, $taskName);
        }

        foreach ($request->items as $itemData) {
            $item = Item::create([
                'user_id' => $task->user_id,
                'task_id' => $task->id,
                'description' => $itemData['description'],
                'priority' => $itemData['priority'],
            ]);
            if (isset($itemData['image'])) {
                foreach ($itemData['image'] as $image) {
                    $itemGallery = new ItemGallery();
                    $taskAbsolutePath = storage_path("app/explorer/$entityName/$siteName/$taskName/Images/");
                    // $destinationPath = 'item_images/';
                    $filename = $image->getClientOriginalName();
                    $image->move($taskAbsolutePath, $filename);
                    $fullPath = "explorer/$entityName/$siteName/$taskName/Images/" . $filename;
                    $itemGallery->item_id = $item->id;
                    $itemGallery->image = $fullPath;
                    $itemGallery->save();
                }
            }
        }

        return redirect()->route('task.index');
    }

    public function edit($task)
    {
        $task = Task::with('items.itemGalleries')->find($task);
        // return $task;
        // base64
        return view('task.edit', ['task' => $task]);
    }

    public function update(Request $request, $task)
    {
        $task = Task::find($task);
        $task->update($request->all());
        $taskId = $task->id;
        $taskOldName = $task->title . " (" . $taskId . ")";
        $taskNewName = $request->input("title") . " (" . $taskId . ")";
        if ($task) {
            //Change task name in all places
            $siteName = Site::find($task->site_id)->site;
            $entity = Entity::find($task->entity_id);
            $manager = new FileExplorerController();
            $entityName = $entity->entity;

            //deleting existing items and item galleries entries against task
            foreach($task->items() as $item){
                ItemGallery::where("item_id", $item->id)->delete();
            }
            Item::where("task_id", $task->id)->delete();

            $manager->deleteFileFolder(new Request(["file"=> "explorer/$entityName/$siteName/$taskOldName/Images/"]));
            $manager->createFolder(new Request(["name"=> "Images", "path"=> "explorer/$entityName/$siteName/$taskOldName"]));

            $task->update($request->all());
            
            if ($entity->type == "Client") {
                $manager->saveEditedData(new Request([
                    "name" => $taskNewName,
                    "path" => "explorer/" . $entityName . "/" . $siteName . "/" . $taskOldName,
                    "isDir" => true,
                    "newParentFolderPath" => "explorer/" . $entityName . "/" . $siteName,
                ]));
            }


            foreach ($request->items as $itemData) {
                $item = Item::create([
                    'user_id' => $task->user_id,
                    'task_id' => $task->id,
                    'description' => $itemData['description'],
                    'priority' => $itemData['priority'],
                ]);


                if (isset($itemData['image'])) {
                    foreach ($itemData['image'] as $image) {
                        $itemGallery = new ItemGallery();
                        $taskAbsolutePath = storage_path("app/explorer/$entityName/$siteName/$taskNewName/Images/");
                        // $destinationPath = 'item_images/';
                        $filename = $image->getClientOriginalName();
                        $image->move($taskAbsolutePath, $filename);
                        $fullPath = "explorer/$entityName/$siteName/$taskNewName/Images/" . $filename;
                        $itemGallery->item_id = $item->id;
                        $itemGallery->image = $fullPath;
                        $itemGallery->save();
                    }
                }
            }

            return redirect()->route('task.index');
        }
    }
}
