<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Event;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class EventController extends Controller
{
    public function index()
            {
                $events = [];
                $data = Event::all();
                if($data->count()) {
                    foreach ($data as $key => $value) {
                        if($value->user_id == Auth::user()->id)
                        $events[] = Calendar::event(
                            $value->title,
                            true,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date.' +1 day'),
                            null,
                            // Add color and link on event
                         [
                             'color' => '#ff0000',
                             'url' => '/tasks/'.strval($value->task_id),
                         ]
                        );
                    }
                }
                $calendar = Calendar::addEvents($events);
               return view('fullcalendar', compact('calendar'));
            }
    
        public function create(Request $request)
        {
            $event = new Event;
            $event->title = $request->input('title');
            $event->start_date = $request->input('start');
            $event->end_date = $request->input('end');
            $event->user_id = Auth::user()->id;
            $event->save();
            return redirect('/events');
        }
}
