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

            foreach($tasks as $task){
                foreach($task_times as $task_time){
                    if($task_time->user_id == $user->id &&
                        $task_time->task_id == $task->id) {
                            $estimatedTime = $task->planned_time;
                            $realTime = $task_time->working_seconds;
                            $diffrence = $realTime - $estimatedTime;
                            $raport = $realTime/$estimatedTime;
                            $percent = round((float)$raport * 100 ) . '%';
                            if ($diffrence < 0) {
                                echo $user->name;
                                echo $task->name . " spent less  on this task with ";
                                echo $diffrence . "seconds";
                                echo " for task $task->title";
                                echo "<br>";
                            }
                            else {
                                echo $user->name;
                                echo $task->name . " Spent more on this task with: ";
                                echo $diffrence . "seconds";
                                echo "for task $task->title";
                                echo "<br>";
                            }

                            echo "It took aprox $percent of the estimated time to complete it <br>";
                    }
                }
            }
    }

    public function list() {
        $users = User::orderBy('id','asc')->get();
        foreach ($users as $user) {
            echo "$user->name  $user->id <br>";
        }
    }
}

