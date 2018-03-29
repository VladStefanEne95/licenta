<?php

use App\Events\MessagePosted;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-pause', 'WorkTimeController@addPause');
Route::get('/start-work-time', 'WorkTimeController@startWorkTime');
Route::get('/add-new-work-time', 'WorkTimeController@addNewWorkTime');

Route::get('/tasks/{id}/start-task-time', 'TaskTimeController@startTaskTime');
Route::get('/tasks/{id}/update-task-time', 'TaskTimeController@updateTaskTime');

Route::get('/get-time-data', 'GetTimeDataController@getData');

Route::resource('tasks', 'TaskController');
Route::get('/tasks/{id}/updateChecklist', 'TaskController@updateChecklist');
Route::resource('positions', 'PositionController');
Route::resource('departaments', 'DepartamentController');
Route::post('tasks/{id}/addComment', 'TaskController@addComment');
Route::post('positions/{id}/changeName', 'PositionController@changeName');
Route::post('departaments/{id}/changeName', 'DepartamentController@changeName');


Route::get('/chat', function () {
    return view('chat');
})->middleware('auth');

Route::get('/messages', function () {
    return App\Message::with('user')->get();
})->middleware('auth');

Route::post('/messages', function () {
    // Store the new message
    $user = Auth::user();
    $message = $user->messages()->create([
        'message' => request()->get('message')
    ]);
    // Announce that a new message has been posted
    broadcast(new MessagePosted($message, $user))->toOthers();
    return ['status' => 'OK'];
})->middleware('auth');

 
Route::get('/gantt', function () {
    return view('gantt');
});
Route::get('events', 'EventController@index');