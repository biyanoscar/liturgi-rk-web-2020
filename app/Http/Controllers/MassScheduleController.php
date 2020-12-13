<?php

namespace App\Http\Controllers;

use App\Models\MassSchedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MassScheduleController extends Controller
{
    //
    public function index()
    {
        $massSchedules = MassSchedule::whereDate('schedule_time', '>', Carbon::today())
            ->where('is_daily_mass', '=', 1)
            ->orderBy('schedule_time')
            ->get();

        // dd($massSchedules);
        // $massSchedules = MassSchedule::all();
        // $massSchedules = MassSchedule::all()->sortByDesc('schedule_time');
        // $massSchedules = MassSchedule::orderBy('schedule_time', 'desc')->get();
        return view('admin.mass_schedules.index', ['massSchedules' => $massSchedules, 'dayName' => 'All']);
    }

    public function edit(MassSchedule $massSchedule)
    {
        return view('admin.mass_schedules.edit', ['massSchedule' => $massSchedule]);
    }

    public function editSong(MassSchedule $massSchedule)
    {
        return view('admin.mass_schedules.edit_song', ['massSchedule' => $massSchedule]);
    }

    public function editReading(MassSchedule $massSchedule)
    {
        return view('admin.mass_schedules.edit_reading', ['massSchedule' => $massSchedule]);
    }

    public function update(MassSchedule $massSchedule)
    {
        $input = request()->all();
        $massSchedule->update($input);

        session()->flash('schedule-updated-message', 'Berhasil update jadwal');

        return redirect()->route('mass_schedules.index');
    }

    public function updateSong(MassSchedule $massSchedule)
    {
        $input = request()->all();
        // $massSchedule->update($input);

        $massSchedule->entrance_song = $input['entrance_song'];
        $massSchedule->alleluia_song = $input['alleluia_song'];
        $massSchedule->recessional_song = $input['recessional_song'];

        //disave sesuai user yg login
        auth()->user()->massSchedules()->save($massSchedule);

        session()->flash('schedule-updated-message', 'Berhasil update susunan lagu');

        return redirect()->route('mass_schedules.index');
    }

    public function getByDayNum($dayNum)
    {
        // Returns the weekday index for date (0 = Monday, 1 = Tuesday, … 6 = Sunday).
        switch ($dayNum) {
            case 0:
                $dayName = 'Senin';
                break;
            case 1:
                $dayName = 'Selasa';
                break;
            case 2:
                $dayName = 'Rabu';
                break;
            case 3:
                $dayName = 'Kamis';
                break;
            case 4:
                $dayName = 'Jumat';
                break;
            case 5:
                $dayName = 'Sabtu';
                break;
            default:
                $dayName = 'All';
        }

        $schedules = DB::select(DB::raw(
            "SELECT * FROM mass_schedules 
            WHERE 
            is_daily_mass = 1
            and schedule_time > CURDATE()
            and WEEKDAY(schedule_time) = :somevariable"
        ), array(
            'somevariable' => $dayNum,
        ));
        // dd($schedules);
        return view('admin.mass_schedules.index', ['massSchedules' => $schedules, 'dayName' => $dayName]);
    }

    public function isiData()
    {
        //tanggal periode awal dan akhir
        $periods = CarbonPeriod::create('2020-12-01', '2020-12-31');

        // Iterate over the period
        foreach ($periods as $date) {
            if ($date->dayOfWeek == 0) {
                //misa hari minggu
                $schedule = new MassSchedule();
                $schedule->schedule_time = $date->format('Y-m-d') . ' 08:00';
                // $schedule->mass_title = 'Misa ' . $date->format('d M');
                $schedule->mass_title = 'Misa ' . $date->isoFormat('D MMM');
                $schedule->is_daily_mass = 0;
                $schedule->user_id = 1; //default user biyan
                $schedule->save();

                $schedule = new MassSchedule();
                $schedule->schedule_time = $date->format('Y-m-d') . ' 16:30';
                $schedule->mass_title = 'Misa ' . $date->isoFormat('D MMM');
                $schedule->is_daily_mass = 0;
                $schedule->user_id = 1; //default user biyan
                $schedule->save();
            } else {
                $schedule = new MassSchedule();
                $schedule->schedule_time = $date->format('Y-m-d') . ' 06:00';
                $schedule->mass_title = 'Misa ' . $date->isoFormat('D MMM');
                $schedule->is_daily_mass = 1;
                $schedule->user_id = 1; //default user biyan
                $schedule->save();
            }
        }

        return redirect()->route('mass_schedules.index');
    }
}
