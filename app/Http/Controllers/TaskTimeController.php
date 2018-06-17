<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\TaskTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskTimeController extends Controller
{
    public function startTaskTime(Request $request) {
        $time = DB::table('task_time')->where('user_id', Auth::user()->id)->where('task_id', Route::input('id'))->first();
        DB::table('task_time')->where('id', $time->id)
        ->update([ 'pause' => 0, 'updated_at' => Carbon::now()]);
    
    }
    public function updateTaskTime(Request $request) {
        $time = DB::table('task_time')->where('user_id', Auth::user()->id)->where('task_id', Route::input('id'))->first();
        DB::table('task_time')->where('id', $time->id)
        ->update(['working_seconds' => $request->input('time'), 'pause' => $request->input('pause'), 'updated_at' => Carbon::now()]);
    }
}
