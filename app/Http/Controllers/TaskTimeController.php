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
        $time = new TaskTime;
        $time->working_seconds = 0;
        $time->user_id = auth()->user()->id;
        $time->task_id = Route::input('id');
        $time->clocked_out = 0;
        $time->clocked_time = 0;
        $time->pause = 0;
        $time->save();
    }
    public function updateTaskTime(Request $request) {
        $time = DB::table('task_time')->where('user_id', Auth::user()->id)->where('task_id', Route::input('id'))->first();
        DB::table('task_time')->where('id', $time->id)
        ->update(['working_seconds' => $request->input('time'), 'pause' => $request->input('pause'), 'updated_at' => Carbon::now()]);
    }
}
