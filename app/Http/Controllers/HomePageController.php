<?php

namespace App\Http\Controllers;

use App\Task;
use RescueTime\RequestQueryParameters as Params;
use RescueTime\Client;
use App\User;
use App\RescueTime;
use \stdClass;
use App\Project;
use App\WorkTime;
use Auth;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    function index() {

    //     $workTimes = WorkTime::all();
    //     $workTimeArr = array();
    //     foreach($workTimes as $workTime) {
    //         if ($workTime->user_id == auth()->user()->id)
    //             array_push($workTimeArr, $workTime);
    //     }
        

    //     $rescues = RescueTime::all();
    //     $rescueTime = [];
    //     foreach ($rescues as $rescue) {
    //         if($rescue->user_id == auth()->user()->id) {
    //             array_push($rescueTime, $rescue);
    //         }
    //     }


    //     $tasks = Task::orderBy('id','asc')->get();
    //     $tasksArr = [];
    //     for ($i = 0; $i < count($tasks); $i++) {
    //         if( strpos($tasks[$i]->assigned_to, '"'.auth()->user()->name.'"' ) || 
    //             strpos($tasks[$i]->assigned_to, '" '.auth()->user()->name.'"' )) 
    //             array_push($tasksArr, $tasks[$i]);
                
    //     }

    //     $projects = Project::orderBy('id','asc')->paginate(10);

    //     $user = Auth::user();
    //     $result = \App\Message::with('user')->orderBy('created_at', 'desc')->get();
    //     $messagesArr = [];
    //     for($i = 0; $i < count($result); $i++) {
    //         if ($result[$i]->user_id == Auth::user()->id   ||
    //         $result[$i]->user_recv_id == Auth::user()->id  )
    //             array_push($messagesArr, $result[$i]);
    //     }
    //     return view('welcome')->with('messages',$messagesArr )
    //     ->with('projects', $projects)
    //     ->with('rescue', $rescueTime)
    //     ->with('work',$workTimeArr)
    //     ->with('tasks', $tasksArr);
    // }
    }
}
