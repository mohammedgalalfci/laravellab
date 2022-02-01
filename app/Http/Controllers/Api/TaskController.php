<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;

class TaskController extends Controller
{
    public function index(){
        $tasks=Task::paginate(3);  
        return TaskResource::collection($tasks);
    }
    public function store(StoreTaskRequest $request){
        $data = request()->all();
        $task=Task::create([
            'title' => $data['title'],
            'user_id' => $data['user_id'],
        ]);
        return new TaskResource($task);
    }
    public function show($task){
        $oneTask=Task::findOrFail($task);
        return new TaskResource($oneTask);
    }

    // public function update($task,Request $req,StoreTaskRequest $request){
    //     $oneTask=Task::findOrFail($task);
    //     $oneTask->update([
    //         'title' => $request['title'],
    //         'user_id' => $request['user_id'],
    //     ]);
    //     return $oneTask;
    // }

    public function delete($task,Request $req){
        $oneTask=Task::findOrFail($task);
        $oneTask->delete();
        return new TaskResource($oneTask);
    }
}
