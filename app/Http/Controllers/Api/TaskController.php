<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Item;
use App\Models\ItemGallery;
use App\Models\Task;
use App\Models\TaskGallery;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use HttpResponses;

    public function createTask(TaskRequest $request){
        $task = Task::create([
            'site_id' => $request->site_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return $this->success([
            'task' => $task,
        ],'Task Created Successfully');
    }

    public function addItem(ItemRequest $request){
        $item = Item::create([
            'task_id' => $request->task_id,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'progress' => $request->progress,
        ]);

        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $image)
            {
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

        return $this->success([
            'item' => $item,
        ],'Item Added Successfully');
    }

    public function fetchTasks(){
        $tasks = Task::with('user', 'site', 'items', 'items.itemGalleries')->where('user_id', Auth::id())->get();
        return $this->success([
            'tasks' => $tasks,
        ],'Fetch all the Tasks');
    }

    // public function storeImage($taskGallery)
    // {
    //     $taskGallery->update([
    //         'image' => $this->imagePath('image', 'task', $taskGallery),
    //     ]);
    // }
}
