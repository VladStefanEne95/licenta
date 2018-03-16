<?php
namespace App\Http\Controllers;
use App\GanttTask;
use App\Link;


class GanttController extends Controller
{
    public function get(){
        $tasks = new GanttTask();
        $links = new Link();
 
        return response()->json([
            "data" => $tasks->orderBy('sortorder')->get(),
            "links" => $links->all()
        ]);
    }
}