<?php

namespace App\Http\Controllers;

use App\Models\Choir;
use App\Models\ChoirMember;
use App\Models\MassSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontPageController extends Controller
{
    public function index()
    {
        // \DB::enableQueryLog();
        $massSchedules = MassSchedule::whereDate('schedule_time', '>=', Carbon::today())
            ->orderBy('schedule_time')
            ->get();

        // dd(\DB::getQueryLog());

        return view('front_page', ['massSchedules' => $massSchedules]);
    }

    public function schedule()
    {
        $massSchedules = MassSchedule::whereDate('schedule_time', '>=', Carbon::today())
            ->orderBy('schedule_time')
            ->get();

        $choirMember = new ChoirMember();


        foreach ($massSchedules as $key => $schedule) {
            $choirName = '';
            if (isset($schedule->ministrySchedule->choir_id)) {
                $choirId = $schedule->ministrySchedule->choir_id;
                $choirName = Choir::find($choirId)->name;
            }
            $massSchedules[$key]['choir_name'] = $choirName;
            
            //tambahkan anggota koor
            if ($schedule->ministrySchedule) {
                $members = $choirMember->getChoirMembersMinistry($schedule->ministrySchedule->id); //get list anggota padus yg tugas
                $massSchedules[$key]['choir_members'] = $members;
            }
        }

        return view('schedule_page', ['massSchedules' => $massSchedules]);
    }
}
