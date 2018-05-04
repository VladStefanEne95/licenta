<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RescueTime\RequestQueryParameters as Params;
use RescueTime\Client;
use App\User;
use App\RescueTime;
use \stdClass;


class GetTimeDataController extends Controller
{
    public function addKey(Request $request) {
        $user = User::find($request->userId);
        $user->apiKey = $request->apikey;
        $user->save();
        return "Changed success";
    }

    public function updateData() {
        $users = User::all();
        foreach($users as $user) {
            if($user->apiKey) {
                $resc = new RescueTime;
                $resc->user_id = $user->id;
                $aux = $this->getDailyProductivity($user->id);
                
                $resc->procent_productivity = $aux->percent;
                $resc->productivity = $aux->value;
                
                $aux = $this->getDailySocialMedia($user->id);
                $resc->procent_social_media = $aux->percent;
                $resc->social_media = $aux->value;
                
                $aux = $this->getDailySocialMedia($user->id);
                $resc->procent_entertainment = $aux->percent;
                $resc->entertainment = $aux->value;
                
                $aux = $this->getDailySocialMedia($user->id);
                $resc->procent_time_pc = $aux->percent;
                $resc->time_pc = $aux->value;

                $resc->day = $aux->date;

                $resc->save();
                break;
            }
        }
    }

    public function getProductivity($id) {
        $rescues = RescueTime::all();
        $result = [];
        foreach ($rescues as $rescue) {
            if($rescue->user_id == $id) {
                array_push($result, $rescue);
            }
        }
        return view('reports.productivity')->with('rescue', $result);
    }

    public function getSocial($id) {
        $rescues = RescueTime::all();
        $result = [];
        foreach ($rescues as $rescue) {
            if($rescue->user_id == $id) {
                array_push($result, $rescue);
            }
        }
        return view('reports.social')->with('rescue', $result);
    }


    public function getEntertainment($id) {
        $rescues = RescueTime::all();
        $result = [];
        foreach ($rescues as $rescue) {
            if($rescue->user_id == $id) {
                array_push($result, $rescue);
            }
        }
        return view('reports.entertainment')->with('rescue', $result);
    }

    public function getOverview($id) {
        $rescues = RescueTime::all();
        $result = [];
        foreach ($rescues as $rescue) {
            if($rescue->user_id == $id) {
                array_push($result, $rescue);
            }
        }
        return view('reports.overview')->with('rescue', $result);
    }


    public function getDailyProductivity($id) {
        $user = User::find($id);
        $apiKey = $user->apiKey;
        $client = new Client($apiKey);
        $result = [];
        $aux = new stdClass();
        $daily_summary = $client->getDailySummary();
        foreach ($daily_summary as $day_summary) {
            $aux->percent = $day_summary->getAllProductivePercentage();
            $aux->value = $day_summary->getAllProductiveHours();
            $aux->date = $day_summary->getDate();
            array_push($result, $aux);
            break;
        }
        return $aux;
    }
    public function getDailySocialMedia($id) {
        $user = User::find($id);
        $apiKey = $user->apiKey;
        $client = new Client($apiKey);
        $result = [];
        $aux = new stdClass();
        $daily_summary = $client->getDailySummary();
        foreach ($daily_summary as $day_summary) {
            $aux->percent = $day_summary->getSocialNetworkingPercentage();
            $aux->value = $day_summary->getSocialNetworkingHours();
            $aux->date = $day_summary->getDate();
            array_push($result, $aux);
            break;
        }
        return $aux;
    }


    public function getDailyEntertainment($id) {
        $user = User::find($id);
        $apiKey = $user->apiKey;
        $client = new Client($apiKey);
        $aux = new stdClass();
        $result = [];
        $daily_summary = $client->getDailySummary();
        foreach ($daily_summary as $day_summary) {
            $aux->percent = $day_summary->getEntertainmentPercentage();
            $aux->value = $day_summary->getEntertainmentHours();
            $aux->date = $day_summary->getDate();
            array_push($result, $aux);
            break;
        }
        return $aux;
    }

    public function getDailyTimeOnWorkPc($id) {
        $user = User::find($id);
        $apiKey = $user->apiKey;
        $client = new Client($apiKey);
        $aux = new stdClass();
        $result = [];
        $daily_summary = $client->getDailySummary();
        foreach ($daily_summary as $day_summary) {
            $aux->percent = 100;
            $aux->value = $day_summary->getTotalHours();
            $aux->date = $day_summary->getDate();
            array_push($result, $aux);
            break;
        }
        return $aux;
    }
    
}

