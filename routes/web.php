<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks',[TaskController::class,'index'])->name('tasks.index')->middleware(['auth']);
Route::get('/tasks/create',[TaskController::class,'create'])->name('tasks.create')->middleware(['auth']);
Route::post('/tasks',[TaskController::class,'store'])->name('tasks.store')->middleware(['auth']);
Route::get('/tasks/{task}',[TaskController::class,'show'])->name('tasks.show')->middleware(['auth']);
Route::get('/tasks/{task}/edit',[TaskController::class,'edit'])->name('tasks.edit')->middleware(['auth']);
Route::put('/tasks/{task}',[TaskController::class,'update'])->name('tasks.update')->middleware(['auth']);
Route::delete('/tasks/{task}',[TaskController::class,'delete'])->name('tasks.destroy')->middleware(['auth']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
