<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMassScheduleFormRequest;
use App\Models\MassSchedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class MassScheduleAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show semua jadwal
        // $massSchedules = MassSchedule::all();
        $massSchedules = MassSchedule::whereDate('schedule_time', '>', Carbon::today())
            ->orderBy('schedule_time')
            ->get();

        return view('admin.mass_schedules_all.index', ['massSchedules' => $massSchedules, 'dayName' => 'All']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.mass_schedules_all.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMassScheduleFormRequest $request)
    {
        // Validation rules di CreateMassScheduleFormRequest
        $formData = $request->all(); //ambil data inputan form

        //masukan user yg sedang login
        $user = auth()->user();
        $formData['user_id'] = $user->id;

        //rubah centangan html jadi value
        // $formData['show_gloria'] = isset($formData['check_gloria']) ? 1 : 0; //centang tampilkan kemuliaan
        // unset($formData['check_gloria']); //dihilangkan, karena ini helper di form saja

        $formData = $this->getCheckBoxValue($formData, 'check_gloria', 'show_gloria');
        $formData = $this->getCheckBoxValue($formData, 'check_is_daily_mass', 'is_daily_mass');

        MassSchedule::create($formData); //Insert data
        session()->flash('schedule-updated-message', 'Jadwal berhasil ditambahkan: ' . $formData['mass_title']);

        return redirect()->route('mass_schedules_all.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MassSchedule $massSchedule)
    {
        return view('admin.mass_schedules_all.edit', ['massSchedule' => $massSchedule]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MassSchedule $massSchedule)
    {
        $formData = request()->all();
        // $input['show_gloria'] = isset($input['check_gloria']) ? 1 : 0; //centang tampilkan kemuliaan
        // unset($input['check_gloria']); //dihilangkan, karena ini helper di form saja

        $formData = $this->getCheckBoxValue($formData, 'check_gloria', 'show_gloria');
        $formData = $this->getCheckBoxValue($formData, 'check_is_daily_mass', 'is_daily_mass');

        // dd($input);
        $massSchedule->update($formData);

        session()->flash('schedule-updated-message', 'Berhasil update jadwal ' . $formData['mass_title']);

        return redirect()->route('mass_schedules_all.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MassSchedule $massSchedule)
    {
        $massSchedule->delete();
        session()->flash('schedule-deleted', 'Deleted Jadwal ' . $massSchedule->mass_title);
        return back();
    }

    //function untuk rubah centangan html jadi value field yg sesuai
    public function getCheckBoxValue($formData, $checkBoxName, $fieldName)
    {
        // //rubah centangan html jadi value
        // $formData['show_gloria'] = isset($formData['check_gloria']) ? 1 : 0; //centang tampilkan kemuliaan
        // unset($formData['check_gloria']); //dihilangkan, karena ini helper di form saja

        //rubah centangan html jadi value
        $formData[$fieldName] = isset($formData[$checkBoxName]) ? 1 : 0; //centang tampilkan kemuliaan
        unset($formData[$checkBoxName]); //dihilangkan, karena ini helper di form saja

        return $formData;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createByDateRange()
    {
        //
        return view('admin.mass_schedules_all.create_by_range');
    }


    public function storeByDateRange()
    {
        request()->validate([
            'start_date' => ['required'],
            'end_date' => ['required']
        ]);

        $input = request()->all();
        // dd($input['start_date']);

        //tanggal periode awal dan akhir ambil dari form
        $periods = CarbonPeriod::create($input['start_date'], $input['end_date']); //rentang tanggal yang diisikan misanya

        // Iterate over the period
        foreach ($periods as $date) {
            if ($date->dayOfWeek == 0) {
                //misa hari minggu
                $this->createSchedule($date, ' 07:00', 0, 1);
                $this->createSchedule($date, ' 10:00', 0, 1);
                $this->createSchedule($date, ' 17:30', 0, 1);
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

    //function untuk insert jadwal misa. $hour -> format jam, misal 08:00
    //isDailyMass=1 -> misa harian
    public function createSchedule($date, $hour, $isDailyMass, $userId, $showGloria = 1)
    {
        $schedule = new MassSchedule();
        $schedule->schedule_time = $date->format('Y-m-d') . $hour;
        // $schedule->mass_title = 'Misa ' . $date->format('d M');
        $schedule->mass_title = 'Misa ' . $date->isoFormat('D MMM');
        $schedule->is_daily_mass = $isDailyMass;
        $schedule->user_id = $userId; //default user
        $schedule->show_gloria = $showGloria;
        $schedule->save();
    }
}
