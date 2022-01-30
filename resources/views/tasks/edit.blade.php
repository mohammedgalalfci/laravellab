@extends('layouts.app')
    @section('title')
        Create
    @endsection
    @section('content')
        <form method='post' action="{{route('tasks.update',['task'=>$task->id])}}" class="row row-cols-lg-auto g-3 align-items-center bg-dark p-3 rounded m-auto" style="width:500px">
            @csrf
            @method('PUT')
            <div class="col-12">
                <input type="text" class="form-control"  placeholder="Title" name='title' value="{{$task->title}}">
            </div>

            <div class="col-12">
                <select name="user_name" class="form-control">
                    @foreach ($users as $user)
                    <option value="{{$user->id}}" @if($user->id==$task->user_id) selected @endif>{{$user->name}}</option> 
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    @endsection