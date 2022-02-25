<?php

namespace App\Http\Controllers;

use App\Models\MassSchedule;
use App\Models\Song;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MassScheduleController extends Controller
{
    public function index()
    {
        $massSchedules = MassSchedule::whereDate('schedule_time', '>', Carbon::today())
            ->where('is_daily_mass', '=', 1)
            ->orderBy('schedule_time')
            ->get();

        return view('admin.mass_schedules.index', ['massSchedules' => $massSchedules, 'dayName' => 'All']);
    }

    public function edit(MassSchedule $massSchedule)
    {
        return view('admin.mass_schedules.edit', ['massSchedule' => $massSchedule]);
    }

    public function editSong(MassSchedule $massSchedule)
    {
        $songs = Song::pluck('title', 'id');
        return view('admin.mass_schedules.edit_song', [
            'massSchedule' => $massSchedule,
            'songs' => $songs,
        ]);
    }

    public function editReading(MassSchedule $massSchedule)
    {
        return view('admin.mass_schedules.edit_reading', ['massSchedule' => $massSchedule]);
    }

    public function update(MassSchedule $massSchedule)
    {
        $input = request()->all();
        $input['show_gloria'] = isset($input['check_gloria']) ? 1 : 0; //centang tampilkan kemuliaan
        unset($input['check_gloria']); //dihilangkan, karena ini helper di form saja

        $massSchedule->update($input);

        session()->flash('schedule-updated-message', 'Berhasil update jadwal');

        if ($massSchedule->is_daily_mass == 0) {
            return redirect()->route('mass_schedules.sunday_masses');
        } else {
            return redirect()->route('mass_schedules.index');
        }
    }

    protected function setSongDataPayload(Request $request)
    {
        $entranceSongId = $request->input('entrance_song_id');
        $kyrieSongId = $request->input('kyrie_song_id');
        $gloriaSongId = $request->input('gloria_song_id');
        $offertorySongId = $request->input('offertory_song_id');
        $sanctusSongId = $request->input('sanctus_song_id');
        $agnusDeiSongId = $request->input('agnus_dei_song_id');
        $communionSongId = $request->input('communion_song_id');
        $songOfPraiseSongId = $request->input('song_of_praise_id');
        $recessionalSongId = $request->input('recessional_song_id');

        return [
            'entrance_song' => ($entranceSongId) ? Song::findOrFail($entranceSongId)->title : null,
            'kyrie_song' => ($kyrieSongId) ? Song::findOrFail($kyrieSongId)->title : null,
            'gloria_song' => ($gloriaSongId) ? Song::findOrFail($gloriaSongId)->title : null,
            'offertory_song' => ($offertorySongId) ? Song::findOrFail($offertorySongId)->title : null,
            'sanctus_song' => ($sanctusSongId) ? Song::findOrFail($sanctusSongId)->title : null,
            'agnus_dei_song' => ($agnusDeiSongId) ? Song::findOrFail($agnusDeiSongId)->title : null,
            'communion_song' => ($communionSongId) ? Song::findOrFail($communionSongId)->title : null,
            'song_of_praise' => ($songOfPraiseSongId) ? Song::findOrFail($songOfPraiseSongId)->title : null,
            'recessional_song' => ($recessionalSongId) ? Song::findOrFail($recessionalSongId)->title : null,

            'alleluia_song' => $request->input('alleluia_song'),
            'lords_prayer_song' => $request->input('lords_prayer_song'),

            'entrance_song_id' => $entranceSongId,
            'kyrie_song_id' => $kyrieSongId,
            'gloria_song_id' => $gloriaSongId,
            'offertory_song_id' => $offertorySongId,
            'sanctus_song_id' => $sanctusSongId,
            'agnus_dei_song_id' => $agnusDeiSongId,
            'communion_song_id' => $communionSongId,
            'song_of_praise' => $songOfPraiseSongId,
            'recessional_song_id' => $recessionalSongId,

            // additional song
            'song_01_notes' => $request->input('song_01_notes'),
            'song_01_id' => $request->input('song_01_id'),
            'song_02_notes' => $request->input('song_02_notes'),
            'song_02_id' => $request->input('song_02_id'),
            'song_03_notes' => $request->input('song_03_notes'),
            'song_03_id' => $request->input('song_03_id'),
            'song_04_notes' => $request->input('song_04_notes'),
            'song_04_id' => $request->input('song_04_id'),
            'song_05_notes' => $request->input('song_05_notes'),
            'song_05_id' => $request->input('song_05_id'),
        ];
    }

    public function updateSong(Request $request, MassSchedule $massSchedule)
    {
        $data = $this->setSongDataPayload($request);

        $massSchedule->update($data);

        session()->flash('schedule-updated-message', 'Berhasil update susunan lagu');

        if ($massSchedule->is_daily_mass == 0) {
            return redirect()->route('mass_schedules.sunday_masses');
        } else {
            return redirect()->route('mass_schedules.index');
        }
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
        return view('admin.mass_schedules.index', ['massSchedules' => $schedules, 'dayName' => $dayName]);
    }

    //function untuk insert jadwal misa. $hour -> format jam, misal 08:00
    //isDailyMass=1 -> misa harian
    public function createSchedule($date, $hour, $isDailyMass, $userId, $showGloria = 1)
    {
        $schedule = new MassSchedule();
        $schedule->schedule_time = $date->format('Y-m-d') . $hour;
        $schedule->mass_title = 'Misa ' . $date->isoFormat('D MMM');
        $schedule->is_daily_mass = $isDailyMass;
        $schedule->user_id = $userId; //default user
        $schedule->show_gloria = $showGloria;
        $schedule->save();
    }

    //untuk isi data otomatis
    public function isiData()
    {
        //tanggal periode awal dan akhir
        $periods = CarbonPeriod::create('2021-01-01', '2021-01-31'); //rentang tanggal yang diisikan misanya

        // Iterate over the period
        foreach ($periods as $date) {
            if ($date->dayOfWeek == 0) {
                //misa hari minggu
                $this->createSchedule($date, ' 08:00', 0, 1);
                $this->createSchedule($date, ' 16:30', 0, 1);
            } elseif ($date->dayOfWeek == 6) {
                //misa hari sabtu
                $userDefault = 10;
                $this->createSchedule($date, ' 06:00', 1, $userDefault);

                $this->createSchedule($date, ' 17:30', 0, 1);
            } else {
                switch ($date->dayOfWeek) {
                    case 1: //'Senin'
                        $userDefault = 2;
                        break;
                    case 2: //Selasa
                        $userDefault = 3;
                        break;
                    case 3:
                        $userDefault = 4;
                        break;
                    case 4:
                        $userDefault = 5;
                        break;
                    case 5:
                        $userDefault = 6;
                        break;
                    default:
                        $userDefault = 1;
                }

                $this->createSchedule($date, ' 06:00', 1, $userDefault);
            }
        }

        return redirect()->route('mass_schedules.index');
    }


    //misa hari minggu
    public function sundayMassesIndex()
    {
        $massSchedules = MassSchedule::with(['ministrySchedule', 'ministrySchedule.choir'])
            ->whereDate('schedule_time', '>', Carbon::today())
            ->where('is_daily_mass', '=', 0)
            ->orderBy('schedule_time');

        // user can only see the schedule of his own 
        if (!(auth()->user()->userHasRole('Liturgi'))) {
            $choirIds = auth()->user()->choirs->pluck('id');
            $massSchedules = $massSchedules->whereHas('ministrySchedule', function ($q) use ($choirIds) {
                $q->whereIn('choir_id', $choirIds);
            });
        }

        $massSchedules = $massSchedules->get();

        return view('admin.mass_schedules.sunday_masses', ['massSchedules' => $massSchedules, 'dayName' => 'All']);
    }

    //show song lyrics for one mass schedule
    public function showLyrics(MassSchedule $massSchedule)
    {
        return view('lyrics_page', ['massSchedule' => $massSchedule]);
    }
}
