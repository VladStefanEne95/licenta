<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\TaskTime;
use App\Task;
use App\User;
use App\WorkTime;
use View;

class ReportsController extends Controller
{
    public function deadline($id)
    {
        $user = User::find($id);
        $tasks = Task::orderBy('id','asc')->get();   
        $task_times = TaskTime::orderBy('id','asc')->get();

            foreach($tasks as $task){
                foreach($task_times as $task_time){
                    if($task_time->user_id == $user->id &&
                        $task_time->task_id == $task->id) {
                            $deadline = new \DateTime($task->deadline);
                            $end_date = new \DateTime($task_time->end_date);
                            $diffrence = $deadline->diff($end_date);
                            $deadline = strtotime($task->deadline);
                            $end_date = strtotime($task_time->end_date);
                            $late = $deadline - $end_date;

                            if($late < 0) {
                                echo $user->name;
                                echo $task->name . " Deadline late: ";
                                echo $diffrence->format("%a days");
                                echo " for task $task->title";
                                echo "<br>";
                            }
                            else {
                                echo $user->name;
                                echo $task->name . " Deadline early: ";
                                echo $diffrence->format("%a days");
                                echo "for task $task->title";
                                echo "<br>";
                            }
                    }
                }
            
        
        }
    }


    public function timeSpent($id)
    {
        $user = User::find($id);
        $tasks = Task::orderBy('id','asc')->get();   
        $task_times = TaskTime::orderBy('id','asc')->get();
        $result = array(); 

            foreach($tasks as $task){
                foreach($task_times as $task_time){
                    if($task_time->user_id == $user->id &&
                        $task_time->task_id == $task->id) {
                            $aux = new \stdClass();
                            // $estimatedTime = $task->planned_time;
                            // $realTime = $task_time->working_seconds;
                            // $diffrence = $realTime - $estimatedTime;
                            // $raport = $realTime/$estimatedTime;
                            // $percent = round((float)$raport * 100 ) . '%';
                            $aux->userName = $user->name;
                            $aux->taskName = $task->id;
                            $aux->taskId = $task->id;
                            $aux->realTime = $task_time->working_seconds;;
                            $aux->estimatedTime = $task->planned_time;
                            array_push($result, $aux);
                    }
                }
            }
            return view('reports.timespent')->with('result', $result);
    }

    public function list() {
        $users = User::orderBy('id','asc')->get();
        return view('reports.list')->with('users', $users);
        
    }
    public function hours($id) {
        $workTimes = WorkTime::all();
        $result = array();
        foreach($workTimes as $workTime) {
            if ($workTime->user_id == $id)
                array_push($result, $workTime);
        }
        return view('reports.hours')->with('result', $result);
    }
}

