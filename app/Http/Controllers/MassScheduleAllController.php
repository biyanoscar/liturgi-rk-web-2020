<?php

namespace App\Http\Controllers;

use App\Actions\CreateMassScheduleByDateRange;
use App\Http\Requests\CreateMassScheduleFormRequest;
use App\Models\MassSchedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class MassScheduleAllController extends Controller
{
    protected $createMassScheduleByDateRange;

    public function __construct(CreateMassScheduleByDateRange $createMassScheduleByDateRange)
    {
        $this->createMassScheduleByDateRange = $createMassScheduleByDateRange;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::today()->subDays(7);
        // show semua jadwal
        $massSchedules = MassSchedule::with(['ministrySchedule', 'ministrySchedule.choir'])
            ->whereDate('schedule_time', '>', $date)
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

        $formData = $this->getCheckBoxValue($formData, 'check_gloria', 'show_gloria');
        $formData = $this->getCheckBoxValue($formData, 'check_is_daily_mass', 'is_daily_mass');
        $formData = $this->getCheckBoxValue($formData, 'check_has_additional_songs', 'has_additional_songs');
        $formData = $this->getCheckBoxValue($formData, 'check_has_additional_reading', 'has_additional_reading');

        MassSchedule::create($formData); //Insert data

        return redirect()
            ->route('mass_schedules_all.index')
            ->with('success', 'Jadwal berhasil ditambahkan: ' . $formData['mass_title']);
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

        $formData = $this->getCheckBoxValue($formData, 'check_gloria', 'show_gloria');
        $formData = $this->getCheckBoxValue($formData, 'check_is_daily_mass', 'is_daily_mass');
        $formData = $this->getCheckBoxValue($formData, 'check_has_additional_songs', 'has_additional_songs');
        $formData = $this->getCheckBoxValue($formData, 'check_has_additional_reading', 'has_additional_reading');

        $massSchedule->update($formData);

        return redirect()
            ->route('mass_schedules_all.index')
            ->with('success', 'Berhasil update jadwal ' . $formData['mass_title']);
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


    public function storeByDateRange(Request $request)
    {
        ($this->createMassScheduleByDateRange)($request->all());

        return redirect()
            ->route('mass_schedules_all.index')
            ->withSuccess('Successfully insert multiple schedules based on range.');
    }
}
