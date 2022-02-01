<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
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

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/callback', function () {
    
    $user = Socialite::driver('github')->user();
    dd($user);
    // $user->token
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => $githubUser->token,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }
    Auth::login($user);

    return redirect('/tasks');
});