<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function fetchTasks(){
        $tasks = Task::with('user', 'site', 'items', 'items.itemGalleries')->get();
        return response()->json([
            'status' => true,
            'tasks' => $tasks,
        ]);
    }
}
