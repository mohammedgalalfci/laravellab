<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
class TaskController extends Controller
{
    public function index(){
        $tasks=Task::with('user')->paginate(3); 
        return view('tasks.index',['tasks'=>$tasks]);
    }

    public function create(){
        $users = User::all();
        return view('tasks.create',['users' => $users]);
    }

    public function store(StoreTaskRequest $request){
        $task = request()->all();
        Task::create([
            'title' => $task['title'],
            'user_id' => $task['user_name'],
        ]);
        return redirect()->route('tasks.index');
    }

    public function show($task){
        $oneTask=Task::findOrFail($task);
        return view('tasks.show',['task'=>$oneTask]);
    }

    public function edit($task){
        $oneTask=Task::findOrFail($task);
        $users = User::all();
        return view('tasks.edit',['task'=>$oneTask,'users'=>$users]);
    }

    public function update($task,Request $req,StoreTaskRequest $request){
        $oneTask=Task::findOrFail($task);
        $oneTask->update([
            'title' => $req['title'],
            'user_id' => $req['user_name'],
        ]);
        return redirect()->route('tasks.index');
    }

    public function delete($task,Request $req){
        $oneTask=Task::findOrFail($task);
        $oneTask->delete();
        return redirect()->route('tasks.index');
    }
}
