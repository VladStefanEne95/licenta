<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Event;
use Carbon\Carbon;
use App\Task;
use View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id','asc')->get();
        $result = [];
        for ($i = 0; $i < count($tasks); $i++) {
            if( strpos($tasks[$i]->assigned_to, '"'.auth()->user()->name.'"' ) )
                array_push($result, $tasks[$i]);
        }
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = new Collection($result);
        $perPage = 5;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );
        return view('tasks.index')->with('tasks', $entries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    public function stripUselessHtml($string)
    {
        $string = str_replace("<html>", "", $string);
        $string = str_replace("</html>", "", $string);
        $string = str_replace("<head>", "", $string);
        $string = str_replace("</head>", "", $string);
        $string = str_replace("<body>", "", $string);
        $string = str_replace("</body>", "", $string);
        $string = str_replace("<!DOCTYPE html>", "", $string);

        return $string;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'title' => 'required',
        //     'description' => 'required',
        //     'deadline' => 'required'
        // ]);


        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $this->stripUselessHtml($request->input('description'));
        $task->priority = $request->input('priority');
        $hours = $request->input('hours');
        $minutes = $request->input('minutes');
        $task->planned_time = $hours * 60 + $minutes;
        $result_json = $request->input('assigned_to');
        $result_json = json_encode( explode(",", $result_json ));
        $task->assigned_to = $result_json;
        $result_json = $request->input('checklists');
        $result_json = explode(",", $result_json );
        $sizeArr = count($result_json);
        for($i = 0; $i < $sizeArr; $i++){
            $result_json[$i] = $result_json[$i]."notdone";
        }

        $result_json = json_encode($result_json);

        $task->checklists = $result_json;
        $result_json = $request->input('observers');
        $result_json = json_encode( explode(",", $result_json ));
        $task->observers = $result_json;
        $task->deadline = $request->input('deadline');
        $task->project = $request->input('project');
        $task->user_id = auth()->user()->id;
        $task->save();

        $event = new Event;
        $event->title = $request->input('title');
        $event->start_date = Carbon::now();
        $event->end_date = $request->input('deadline');
        $event->user_id = Auth::user()->id;
        $event->task_id = $task->id;
        $event->save();
        
        return redirect('/tasks')->with('success', 'Task Created');
    }

    public function updateChecklist(Request $request) 
    {
        $task = new Task;
        $task = Task::where('id', Route::input('id'))->first();
        if(strpos($task->checklists,($request->data . "notdone")) !== false ) {
           $task->checklists = str_replace($request->data . "notdone", $request->data . "done", $task->checklists);
           $task->save();
        }
        else {
            $task->checklists = str_replace($request->data . "done", $request->data . "notdone", $task->checklists);
            $task->save();
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $time = DB::table('task_time')->where('user_id', Auth::user()->id)->where('task_id', $id)->first();
        
        if($time)
            if($time->pause == 0){
                $ts1 = strtotime(Carbon::now());
                $ts2 = strtotime($time->updated_at);
                $time->working_seconds +=  ($ts1 - $ts2);
            }
        $task->assigned_to = json_decode($task->assigned_to);
        $task->observers = json_decode($task->observers);
        $task->checklists = json_decode($task->checklists);
        $task->comment = json_decode($task->comment);
        
        return view('tasks.show')->with('task', $task)->with('time', $time);
    }

    public function addComment(Request $request,$id)
    {
        $task = Task::find($id);
        $comment = json_decode($task->comment);
        if($comment) {
            array_push($comment, $request->comment);
            array_push($comment, Auth::user()->name);
        }
        else {
            $comment = [];
            array_push($comment, $request->comment);
            array_push($comment, Auth::user()->name);
        }
        $task->comment = json_encode($comment);
        $task->save();
        return Redirect::back()->with('success','Comment added !');
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        // Check for correct user

        if(auth()->user()->id !== $task->user_id){
            return redirect('/tasks')->with('error', 'Unauthorized Page');
        }
        
        return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required'
        ]);


        $task = Task::find($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');
        $task->user_id = auth()->user()->id;
        $task->save();
        return redirect('/tasks')->with('success', 'Task Updated');
    }
    
    public function finishTask(Request $request)
    {
        $id = Route::input('id');
        $task = Task::find($id);
        $task->done = 1;
        $task->save();
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if(auth()->user()->id !== $task->user_id){
            return redirect('/tasks')->with('error', 'Unauthorized Page');
        }

        $task->delete();
        return redirect('/tasks')->with('success', 'Task Removed');
    }
}
