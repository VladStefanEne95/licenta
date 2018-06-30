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
                                'color' => '#1E9FF2',
                                'url' =>  $value->task_id ? '/tasks/'.strval($value->task_id): NULL
                            ]
                            );
                                else {
                                $eventsArr = explode(" ", $value->user_id);
                                foreach ($eventsArr as $ev) {
                                    if($ev == Auth::user()->id)
                                    $events[] = Calendar::event(
                                        $value->title,
                                        true,
                                        new \DateTime($value->start_date),
                                        new \DateTime($value->end_date.' +1 day'),
                                        null,
                                        // Add color and link on event
                                    [
                                        'color' => '#1E9FF2',
                                        'url' =>  $value->task_id ? '/tasks/'.strval($value->task_id): NULL
                                    ]
                                    );  
                                }
                            }
                    }
                }
                $calendar = Calendar::addEvents($events)->setOptions(['allDayDefault' => true]);
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
