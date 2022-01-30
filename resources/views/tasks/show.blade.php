@extends('layouts.app')
    @section('title')
        Create
    @endsection
    @section('content')
    <div class="card text-center">
    <div class="card-header">
        Title : {{$task->title}}
    </div>
    <div class="card-body">
        <h5 class="card-title">Created By : {{$task->user->name}}</h5>
        <p class="card-text">Created At : {{$task->created_at->format("Y-m-d")}}</p>
    </div>
    <div class="card-footer text-muted">
        Welcome here
    </div>
    </div>
    @endsection