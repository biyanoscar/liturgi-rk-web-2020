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
        // \DB::enableQueryLog();
        $massSchedules = MassSchedule::whereDate('schedule_time', '>=', Carbon::today())
            // ->where('is_daily_mass', '=', 1)
            ->orderBy('schedule_time')
            ->get();

        // dd(\DB::getQueryLog());
        // dd($massSchedules);

        return view('front_page', ['massSchedules' => $massSchedules]);
    }
}
