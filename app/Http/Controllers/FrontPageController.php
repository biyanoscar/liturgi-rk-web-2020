<?php

namespace App\Http\Controllers;

use App\Models\Choir;
use App\Models\ChoirMember;
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

    public function schedule()
    {
        $massSchedules = MassSchedule::whereDate('schedule_time', '>=', Carbon::today())
            ->orderBy('schedule_time')
            ->get();

        $choirMember = new ChoirMember();


        foreach ($massSchedules as $key => $schedule) {
            // var_dump($schedule->schedule_time);
            $choirName = '';
            if (isset($schedule->ministrySchedule->choir_id)) {
                $choirId = $schedule->ministrySchedule->choir_id;
                $choirName = Choir::find($choirId)->name;
            }
            $massSchedules[$key]['choir_name'] = $choirName;
            //tambahkan anggota koor
            // $massSchedules[$key]['choir_members'] = [
            //     ['name' => 'Budi', 'no_kk' => '123'],
            //     ['name' => 'Anton', 'no_kk' => '12345']
            // ];
            // $massSchedules[$key]['tambahan'] = '->addon';


            if ($schedule->ministrySchedule) {
                $members = $choirMember->getChoirMembersMinistry($schedule->ministrySchedule->id); //get list anggota padus yg tugas
                $massSchedules[$key]['choir_members'] = $members;
                // var_dump($members);
                // var_dump($schedule->ministrySchedule->id);
            }
        }
        // dd($massSchedules);

        // foreach ($massSchedules as $key => $schedule) {
        //     // var_dump($schedule->choir_members);
        //     if ($schedule->choir_members) {
        //         foreach ($schedule->choir_members  as $member) {
        //             var_dump($member);
        //         }
        //     }
        // }

        return view('schedule_page', ['massSchedules' => $massSchedules]);
    }
}
