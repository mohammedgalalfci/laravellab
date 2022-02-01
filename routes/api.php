<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/tasks',[TaskController::class,'index'])->middleware('auth:sanctum');
Route::post('/tasks',[TaskController::class,'store'])->middleware('auth:sanctum');
Route::get('/tasks/{task}',[TaskController::class,'show'])->middleware('auth:sanctum');
Route::put('/tasks/{task}',[TaskController::class,'update'])->middleware('auth:sanctum');
Route::delete('/tasks/{task}',[TaskController::class,'delete'])->middleware('auth:sanctum');

Route::post('/auth', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});


