<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departament;
use View;

class DepartamentController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departaments = Departament::orderBy('id','asc')->paginate(10);
        return view('departaments.index')->with('departaments', $departaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departaments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departament = new Departament;
        $departament->name = $request->input('name');
        $departament->owner = "no";
        $departament->save();
        return redirect('/departaments')->with('success', 'Departament Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departament = Departament::find($id);
        return view('departaments.show')->with('departament', $departament);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changeName(Request $request, $id) 
    {
        $departament = Departament::find($id);
        $departament->name = $request->name;
        $departament->save();
        return redirect('/departaments')->with('success', 'Departament Updated');
    }

    public function edit($id)
    {
        $departament = $departament::find($id);        
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
        $departament = Departament::find($id);
        $departament->name = $request->input('name');
        $departament->save();
        return redirect('/departaments')->with('success', 'Departament Updated');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departament = Departament::find($id);

        $departament->delete();
        return redirect('/departaments')->with('success', 'Departament Removed');
    }
}

