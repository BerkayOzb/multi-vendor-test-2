<?php

use App\Events\UserRegistered;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Jobs\SendMail;
use App\Mail\OrderShipped;
use App\Mail\PostPublished;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Group Middleware
Route::group(["middleware" => "authCheck"], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get('/profile', function () {
        return view('profile');
    });
});

// CRUD ROUTES - Auth middleware
Route::group(["middleware" => 'auth'], function () {
    Route::get('/posts/trash', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force_delete');
    Route::resource('posts', PostController::class);
});
// CRUD ROUTES END

//Breeze Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Breeze Routes End


//Global Middleware
Route::get('/unavailable', function () {
    return view('unavailable');
})->name('unavailable');


Route::get('contact', function () {
    $posts = Post::all();
    return view('contact', compact('posts'));
});

Route::get('send-mail', function () {
    // Mail::raw('Test mail body',function($message){
    //     $message->to('lwoberkay@gmail.com')->subject('noreply');
    // });
    Mail::send(new OrderShipped);
});

Route::get('send-maill',function(){
    SendMail::dispatch();
});

Route::get('user-register', function(){
    $email = 'asdasd@asd.com';
    event(new UserRegistered($email));
});

Route::get('get-session', function (Request $request) {
    $data = $request->session()->all();
    // $data = $request->session()->get('_token');
    dd($data);
});

Route::get('save-session', function (Request $request) {
    // $request->session()->put('user_status','Logged_in');
    session(['user_ip' => '12.12.12.12']);
    return redirect('get-session');
});

Route::get('destroy-session', function (Request $request) {
    $request->session()->forget(['user_id', 'user_status']);
    session()->forget(['user_ip']);
    session()->flush();
});

Route::get('flash-session', function (Request $request) {
    $request->session()->flash('status', 'true');
    return redirect('get-session');
});
Route::get('forget-cache', function () {
    Cache::forget('posts');
});

Route::get('user-data', function () {
    return auth()->user()->name;
});

require __DIR__ . '/auth.php';

Route::get('greeting',function(){
    return view('greeting');
});
