<?php

namespace App\Http\Controllers;

use App\Models\DriveLink;
use App\Models\MassSchedule;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontPageController extends Controller
{
    public function index()
    {
        // \DB::enableQueryLog();
        $massSchedules = MassSchedule::with(['song01', 'song02', 'song03', 'song04', 'song05'])
            ->whereDate('schedule_time', '>=', Carbon::today())
            ->orderBy('schedule_time')
            ->get();

        // dd(\DB::getQueryLog());

        return view('frontpages.index', ['massSchedules' => $massSchedules]);
    }

    public function schedule()
    {
        $massSchedules = MassSchedule::whereDate('schedule_time', '>=', Carbon::today())
            ->with(['ministrySchedule', 'ministrySchedule.choir', 'ministrySchedule.organist', 'ministrySchedule.choirMember' ])
            ->orderBy('schedule_time')
            ->get();

        foreach ($massSchedules as $key => $schedule) {
            $ministrySchedule = $schedule->ministrySchedule;
            
            //add choir on schedule list table
            $choirName = (isset($ministrySchedule->choir_id)) ? $ministrySchedule->choir->name : '' ;
            $massSchedules[$key]['choir_name'] = $choirName;

            //add organist on schedule list table
            $organistName = '';
            $organistNoKK = '';
            if (isset($ministrySchedule->organist_id)) {
                $organist = $ministrySchedule->organist;
                $organistName = $organist->name;
                $organistNoKK = $organist->no_kk;
            }
            $massSchedules[$key]['organist_name'] = $organistName;
            $massSchedules[$key]['organist_no_kk'] = $organistNoKK;
            
            //tambahkan anggota koor
            if ($ministrySchedule) {
                $members = $ministrySchedule->choirMember;
                $massSchedules[$key]['choir_members'] = $members;
            }
        }

        return view('frontpages.schedules', ['massSchedules' => $massSchedules]);
    }

    //show song lyrics for one mass schedule
    public function showLyrics(MassSchedule $massSchedule)
    {
        return view('frontpages.lyrics', ['massSchedule' => $massSchedule]);
    }

    public function showMassText()
    {
        $setting = Setting::where('slug', '=', 'drive-link-id')->first();
        $driveLinkId = ($setting) ? $setting->value : '1DLpmGMJXHHpFL9KynT_dAqQXJ-d_C29_' ;
        return view('frontpages.mass_text', ['driveLinkId' => $driveLinkId]);
    }

    public function driveLinksPage()
    {
        $driveLinks = DriveLink::active()->orderBy('order_num')->get();

        return view('frontpages.drive_links', ['driveLinks' => $driveLinks]);
    }
}
