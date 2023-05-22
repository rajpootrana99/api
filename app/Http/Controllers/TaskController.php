<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemGallery;
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
            $task->items()->delete();
            $task->delete();
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

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'site_id' => ['required'],
            'title' => ['required'],
        ]);
        $task = Task::create($request->all());

        foreach ($request->items as $itemData) {
            $item = Item::create([
                'task_id' => $task->id,
                'description' => $itemData['description'],
                'priority' => $itemData['priority'],
                'status'=> $itemData['status'],
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
        return redirect()->route('task.index');

    }
}
