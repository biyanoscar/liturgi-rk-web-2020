<?php

namespace App\Http\Controllers;

use App\Models\MassSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontPageController extends Controller
{
    //
    public function index()
    {
        $massSchedules = MassSchedule::whereDate('schedule_time', '>=', Carbon::today())
            ->where('is_daily_mass', '=', 1)
            ->get();

        return view('front_page', ['massSchedules' => $massSchedules]);
    }
}
