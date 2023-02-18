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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    use HttpResponses;

    public function createTask(Request $request){
        $validator = Validator::make($request->all(),[
            'site_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()){
            $message = $validator->errors();
            return $this->error('', $message->first(), 401);
        }

        $task = Task::create([
            'site_id' => $request->site_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return response()->json($task);
    }

    public function addItem(Request $request){
        $validator = Validator::make($request->all(),[
            'task_id' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:32'],
            'priority' => ['required', 'integer', Rule::in([0, 1, 2])],
            'status' => ['required', 'integer', Rule::in([0, 1, 2])],
            'progress' => ['required', 'integer', Rule::in([0, 1])],
            'images[]' => ['mimes:png,jpg,mp4,mkv,doc,docx'],
        ]);

        if($validator->fails()){
            $message = $validator->errors();
            return $this->error('', $message->first(), 401);
        }

        $item = Item::create([
            'task_id' => $request->task_id,
            'user_id' => Auth::id(),
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

        return response()->json($item);
    }

    public function fetchTasks(){
        $tasks = Task::with('user', 'site', 'items', 'items.itemGalleries')->where('user_id', Auth::id())->get();
        return response()->json($tasks);
    }

    public function groupTasks(){
        $tasks = Item::groupBy('status')->select('status', DB::raw('count(*) as total'))->where('user_id', Auth::id())->get();
        return response()->json($tasks);
    }

    // public function storeImage($taskGallery)
    // {
    //     $taskGallery->update([
    //         'image' => $this->imagePath('image', 'task', $taskGallery),
    //     ]);
    // }
}
