<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $allTasks=[
            [
                'id'=>1,
                'title'=>'title1',
                'created_by'=>'mohammed',
                'created_at'=>'2022-1-20',
            ],
            [
                'id'=>2,
                'title'=>'title2',
                'created_by'=>'ahmed',
                'created_at'=>'2022-1-22',
            ],
            [
                'id'=>3,
                'title'=>'title3',
                'created_by'=>'khaled',
                'created_at'=>'2022-2-1',
            ]
        ];
        return view('tasks.index',['tasks'=>$allTasks]);
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(){
        return redirect()->route('tasks.index');
    }

    public function show($task){
        dd($task);
        return view('tasks.show',$task);
    }

    public function edit($task){
        dd($task);
        return view('tasks.edit',$task);
    }
}
