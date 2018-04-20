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
        $projects = Project::orderBy('id','asc')->paginate(10);
        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
        $project->description = $request->input('description');
        $project->client = $request->input('client');
        $project->owner = $request->input('owner');
        $result_json = $request->input('users');
        $result_json = json_encode( explode(",", $result_json ));
        $project->users = $result_json;

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

    public function changeName(Request $request, $id) 
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->save();
        return redirect('/projects')->with('success', 'Project Updated');
    }

    public function list() 
    {
        $projects = Project::orderBy('id','asc')->get();
        $result = [];
        for ($i = 0; $i < count($projects); $i++) {
            if( strpos($projects[$i]->users, '"'.auth()->user()->name.'"' ) )
                array_push($result, $projects[$i]);
        }
        return view('chatprojects')->with('projects', $result);
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
