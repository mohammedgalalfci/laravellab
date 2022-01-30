@extends('layouts.app')
    @section('title')
        Create
    @endsection
    @section('content')
        <form method='post' action='{{route("tasks.store")}}' class="row row-cols-lg-auto g-3 align-items-center bg-dark p-3 rounded m-auto" style="width:500px">
            @csrf
            <div class="col-12">
                <input type="text" class="form-control"  placeholder="Title">
            </div>

            <div class="col-12">
                <div class="input-group">
                    <div class="input-group-text">@</div>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
            </div>

            <div class="col-12">
                <input type="date" class="form-control">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    @endsection