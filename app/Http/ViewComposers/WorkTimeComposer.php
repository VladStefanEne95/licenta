<?php

namespace App\Http\ViewComposers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Carbon\Carbon;

class WorkTimeComposer
{
    public function compose(View $view) {
        $timer_null = new \stdClass();
        $timer_null->working_seconds = 0;
        $timer_null->pause = 0;
        $timer_null->clocked_out = 0;
        $timer_null->clocked_time = 0;
        if(Auth::user()) {
            $timer = DB::table('worktime')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        
            if ($timer->clocked_out == 0) {
                if ($timer->pause == 0) {
                    $ts1 = strtotime(Carbon::now());
                    $ts2 = strtotime($timer->updated_at);
                    $timer->working_seconds +=  ($ts1 - $ts2);
                }
                $view->with('timer', $timer);
            }
            else    
                $view->with('timer', $timer_null);
        }
        else
            $view->with('timer', $timer_null);
    }
}
