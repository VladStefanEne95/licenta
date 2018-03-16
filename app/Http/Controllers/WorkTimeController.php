<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkTimeController extends Controller
{
    public function startWorkTime(Request $request) {
        $time = new WorkTime;
        $time->working_seconds = 0;
        $time->user_id = auth()->user()->id;
        $time->clocked_out = 0;
        $time->clocked_time = 0;
        $time->pause = 0;
        $time->save();
    }
    public function addNewWorkTime(Request $request) {
        $time = DB::table('worktime')->where('user_id', Auth::user()->id)
        ->orderBy('id', 'desc')->first();
        DB::table('worktime')->where('id', $time->id)
        ->update(['working_seconds' => $request->input('time'), 'clocked_out' => 1, 'updated_at' => Carbon::now()]);
    }
    public function addPause(Request $request) {
        $time = DB::table('worktime')->where('user_id', Auth::user()->id)
        ->orderBy('id', 'desc')->first();
        DB::table('worktime')->where('id', $time->id)
        ->update(['working_seconds' => $request->input('time'), 'pause' => $request->input('pause'), 'updated_at' => Carbon::now()]);
    }
}
