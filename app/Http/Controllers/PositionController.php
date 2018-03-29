<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use View;

class PositionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::orderBy('id','asc')->paginate(10);
        return view('positions.index')->with('positions', $positions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = new Position;
        $position->name = $request->input('name');
        $position->user_id = auth()->user()->id;
        $position->save();
        
        return redirect('/positions')->with('success', 'Position Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = Position::find($id);
        return view('positions.show')->with('position', $position);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changeName(Request $request, $id) 
    {
        $position = Position::find($id);
        $position->name = $request->name;
        $position->save();
        return redirect('/positions')->with('success', 'Position Updated');
    }

    public function edit($id)
    {
        $position = $position::find($id);        
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
        $position = Position::find($id);
        $position->name = $request->input('name');
        $position->save();
        return redirect('/positions')->with('success', 'Position Updated');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::find($id);

        $position->delete();
        return redirect('/positions')->with('success', 'Position Removed');
    }
}
