@extends('layouts.app')
    @section('title')
        Index
    @endsection
    @section('content')
        <a href="{{route('tasks.create')}}" class="btn btn-success">Create Task</a>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created by</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $i=>$task)
                    <tr>
                        <th scope="row">{{$i+1}}</th>
                        <td>{{$task->title}}</td>
                        <td>{{ isset($task->user) ? $task->user->name : '-----' }}</td>
                        <td>{{$task->created_at->format("Y-m-d")}}</td>
                        <td>
                            <a href="{{route('tasks.show',['task'=>$task['id']])}}" class="btn btn-info">View</a>
                            <a href="{{route('tasks.edit',['task'=>$task['id']])}}" class="btn btn-success">Update</a>
                            <form method='post' action="{{route('tasks.destroy',['task'=>$task->id])}}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection