<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RescueTime\RequestQueryParameters as Params;
use RescueTime\Client;


class GetTimeDataController extends Controller
{
    public function getData() {
        $apiKey = "B63vay8hl4pck1RGkVDGXbiINBm4DvGa3FiWYdyh";
        $client = new Client($apiKey);

        // Basic example
        $activities = $client->getActivities(
            new Params([
                'perspective' => 'interval',
                'resolution_time' => 'day',
                'restrict_begin' => new \DateTime("-14 day"),
                'restrict_end' => new \DateTime("today")
            ])
        );
        

        $activities = $client->getActivities(
            new Params([
                'perspective' => 'interval',
                'resolution_time' => 'day',
                'restrict_begin' => new \DateTime("-10 day"),
                'restrict_end' => new \DateTime("today"),
                'restrict_kind' => 'activity'
            ])
        );
        

        foreach ($activities as $activity) {
            echo $activity->getActivityName();
            echo $activity->getProductivity();
            echo $activity->getTimeSpentSeconds();
            echo "<br>";
        }

    }
}

