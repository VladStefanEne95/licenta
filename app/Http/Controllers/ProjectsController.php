<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Project;
use View;

class ProjectsController extends Controller
{
       
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id','desc')->paginate(10);
        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->name == 'Vlad')
            return view('projects.create');
        else
            return redirect('/projects')->with('error', 'Unauthorized access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project;
        $project->name = $request->input('name');
        $project->description = $this->stripUselessHtml($request->input('description'));
        $project->client = $request->input('client');
        $project->owner = $request->input('owner');
        $result_json = $request->input('users');
        $result_json = json_encode( explode(",", $result_json ));
        $project->users = $result_json;
        $project->deadline = $request->input('deadline');

        $project->save();
        return redirect('/projects')->with('success', 'Project Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = Task::where('project', $id)->orderBy('id','asc')->get();
        $project = Project::find($id);
        return view('projects.show')->with('project', $project)->with('tasks', $tasks);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $project = Project::find($id);
        if(auth()->user()->name !== $project->owner){
            return redirect('/tasks')->with('error', 'Unauthorized Page');
        }
                
        return view('projects.edit')->with('project', $project);
    }

    public function changeName(Request $request, $id) 
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->save();
        return redirect('/projects')->with('success', 'Project Updated');
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

    public function list() 
    {
        $projects = Project::orderBy('id','asc')->get();
        $result = [];
        for ($i = 0; $i < count($projects); $i++) {
            if( strpos($projects[$i]->users, '"'.auth()->user()->name.'"' ) )
                array_push($result, $projects[$i]);
        }
        $result2 = \App\Message::orderBy('created_at', 'desc')->get();
        $result_ret = [];
        for($i = 0; $i < count($result2); $i++) {
            foreach($result as $res) {
                if($result2[$i]->project == $res->id)
                    array_push($result_ret, $result2[$i]);
            }
        }
        return view('chatprojects')->with('projects', $result)->with('msgs', $result_ret);
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
        $project = Project::find($id);
        $project->name = $request->input('name');
        $project->save();
        return redirect('/projects')->with('success', 'Project Updated');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        $project->delete();
        return redirect('/projects')->with('success', 'Project Removed');
    }
}
