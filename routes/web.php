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
 



Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
        Route::get('/add-user', 'AddUserController@index');
        Route::get('/delete-user/{id}', 'AddUserController@deleteUser');
        Route::get('/edit/{id}', 'UserController@edit');
        Route::get('/update-rescue', 'GetTimeDataController@updateData');
        Route::post('/add-key', 'GetTimeDataController@addKey');
        Route::get('/reports', 'ReportsController@list');
        Route::get('/gantt', function () {
            return view('gantt');
        });
    });

Route::get('/', 'TaskController@index');


Route::get('/get-productivity/{id}', 'GetTimeDataController@getProductivity');
Route::get('/get-social/{id}', 'GetTimeDataController@getSocial');
Route::get('/get-entertainment/{id}', 'GetTimeDataController@getEntertainment');
Route::get('/get-overview/{id}', 'GetTimeDataController@getOverview');

Route::get('/get-productivity', 'GetTimeDataController@getProductivityAll');
Route::get('/get-social', 'GetTimeDataController@getSocialAll');
Route::get('/get-entertainment', 'GetTimeDataController@getEntertainmentAll');
Route::get('/get-overview', 'GetTimeDataController@getOverviewAll');
Route::get('/report-deadline/{id}', 'ReportsController@deadline');
Route::get('/report-time-spent/{id}', 'ReportsController@timeSpent');
Route::get('/report-hours/{id}', 'ReportsController@hours');


Route::get('/confirm/{id}', 'AddUserController@confirm');
Route::post('/update-pass/{id}', 'AddUserController@updatePas');
Route::post('/register-email', 'AddUserController@regEmail');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-pause', 'WorkTimeController@addPause');
Route::get('/start-work-time', 'WorkTimeController@startWorkTime');
Route::get('/add-new-work-time', 'WorkTimeController@addNewWorkTime');

Route::get('/tasks/{id}/finish-task', 'TaskController@finishTask');


Route::get('/tasks/{id}/start-task-time', 'TaskTimeController@startTaskTime');
Route::get('/tasks/{id}/update-task-time', 'TaskTimeController@updateTaskTime');



Route::resource('tasks', 'TaskController');
Route::get('/tasks/{id}/updateChecklist', 'TaskController@updateChecklist');
Route::resource('positions', 'PositionController');
Route::resource('departaments', 'DepartamentController');

Route::resource('projects', 'ProjectsController');

Route::post('tasks/{id}/addComment', 'TaskController@addComment');
Route::post('positions/{id}/changeName', 'PositionController@changeName');
Route::post('departaments/{id}/changeName', 'DepartamentController@changeName');


Route::get('/chat/users', function () {
    $user = Auth::user();
    $result = App\Message::with('user')->orderBy('created_at', 'desc')->get();
    $result_ret = [];
    for($i = 0; $i < count($result); $i++) {
        if ($result[$i]->user_id == Auth::user()->id   ||
        $result[$i]->user_recv_id == Auth::user()->id  )
            array_push($result_ret, $result[$i]);
    }
    return view('chatusers')->with('msgs', $result_ret);
})->middleware('auth');

Route::get('/chat/projects', 'ProjectsController@list');


Route::get('/chat/users/{id}', function () {
    return view('chat');
})->middleware('auth');

Route::get('/chat/projects/{id}', function () {
    return view('chat2');
})->middleware('auth');

Route::get('/messages/{id}', function ($id) {
    $user = Auth::user();
    $result = App\Message::with('user')->get();
    $result_ret = [];
    for($i = 0; $i < count($result); $i++) {
        if( ($result[$i]->user_id == Auth::user()->id && $result[$i]->user_recv_id == $id)  ||
        ($result[$i]->user_id == $id && $result[$i]->user_recv_id == Auth::user()->id ) )
            array_push($result_ret, $result[$i]);
    }
    return $result_ret;
})->middleware('auth');

Route::get('/msgProjects/{id}', function ($id) {
    $user = Auth::user();
    $result = App\Message::with('user')->get();
    $result_ret = [];
    for($i = 0; $i < count($result); $i++) {
         if( $result[$i]->project == $id)
             array_push($result_ret, $result[$i]);
     }
     return $result_ret;
})->middleware('auth');

Route::post('/messages/{id}', function ($id) {
    // Store the new message
    $user = Auth::user();
    $message = request()->get('message');
    $message = $user->messages()->create([
        'message' => $message,
        'user_recv_id' => $id
    ]);

    // Announce that a new message has been posted
    broadcast(new MessagePosted($message, $user))->toOthers();
    return ['status' => 'OK'];
})->middleware('auth');

Route::post('/msgProjects/{id}', function ($id) {
    // Store the new message
    $user = Auth::user();
    $message = request()->get('message');
    $message = $user->messages()->create([
        'message' => $message,
        'project' => $id
    ]);

    // Announce that a new message has been posted
    broadcast(new MessagePosted($message, $user))->toOthers();
    return ['status' => 'OK'];
})->middleware('auth');

 

Route::get('/events', 'EventController@index');
Route::post('/addEvent', 'EventController@create');
Route::get('/fileupl', function() {
    return view('fileupl');
});
Route::get('/fileshow', function() {
    return view('fileshow');
});

});