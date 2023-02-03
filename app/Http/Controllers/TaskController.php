<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(){
        return view('task.index');
    }

    public function fetchTasks(){
        $tasks = Task::with('user', 'site', 'items', 'items.itemGalleries')->get();
        return response()->json([
            'status' => true,
            'tasks' => $tasks,
        ]);
    }

    public function show($task)
    {
        $task = Task::with('user', 'site', 'items', 'items.itemGalleries')->where('id', $task)->first();
        if($task){
            return response()->json([
                'status' => 200,
                'task' => $task
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Task not found'
            ]);
        }
    }
}
