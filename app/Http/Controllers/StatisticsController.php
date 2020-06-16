<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StatisticsController extends Controller
{
    public function getDate_api($date)
    {
        if (isset($date)) {
            $date = date('Y-m-d', strtotime($date));
            $amount = Redis::get($date);
            return isset($amount) ? response()->json($amount) : response()->json(0);
        }
        return response()->json(0);
    }
    public function getURL_api($url)
    {
        if (isset($url)) {
            $base = (string) asset('/');
            $amount = Redis::get("$base$url");
            return isset($amount) ? response()->json($amount) : response()->json(0);
        }
        return response()->json(0);
    }
    public function getDateURL_api($date, $url)
    {
        if (isset($date) && isset($url)) {
            $base = (string) asset('/');
            $query = "$date:$base$url";
            $amount = Redis::get($query);
            return isset($amount) ? response()->json($amount) : response()->json(0);
        }
        return response()->json(0);
    }
}
