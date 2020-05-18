<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Calendar;


class CalendarController extends Controller
{
    public function index(Request $request) {
        $today = Carbon::today();

        $cal = new Calendar($today);

        $tag = $cal->showCalendarTag($request->month, $request->year);

        return view('calendar', ['cal_tag' => $tag]);
    }
}
