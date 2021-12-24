<?php

namespace App\Http\Controllers\Summary;

use Carbon\Carbon;
use App\Models\MassSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChoirScheduleController extends Controller
{
    public function index()
    {
        $massSchedules = MassSchedule::whereDate('schedule_time', '>=', Carbon::today())
            ->where('is_daily_mass', '=', 0)
            ->with(['ministrySchedule', 'ministrySchedule.choir', 'ministrySchedule.organist', 'ministrySchedule.choirMember'])
            ->orderBy('schedule_time')
            ->get();

        foreach ($massSchedules as $key => $schedule) {
            $ministrySchedule = $schedule->ministrySchedule;

            //tambahkan anggota koor
            if ($ministrySchedule) {
                $massSchedules[$key]['choir_members'] = $ministrySchedule->choirMember;
            }
        }

        return view('admin.summary.choir_schedule.index')
            ->with('massSchedules', $massSchedules);
    }
}
