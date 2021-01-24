<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMassScheduleFormRequest;
use App\Models\MassSchedule;
use Carbon\Carbon;
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
        $input = request()->all();
        $input['show_gloria'] = isset($input['check_gloria']) ? 1 : 0; //centang tampilkan kemuliaan
        unset($input['check_gloria']); //dihilangkan, karena ini helper di form saja

        // dd($input);
        $massSchedule->update($input);

        session()->flash('schedule-updated-message', 'Berhasil update jadwal');

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
}
