<?php

use App\Events\MessageEvent;
use App\Events\SendMessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('sendM', function () {
    // dd('test');
    broadcast(new SendMessageEvent('Test'));
});


// 

Route::get('chat', function(){
    return view('user.index');
});

Route::post('sendMessage', function (Request $request) {
    
    event(
        new MessageEvent(
            $request->userName,
            $request->userMessage
        )
    );
    
    return $request;
})->name('send-message');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
