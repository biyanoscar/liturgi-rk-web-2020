<?php

namespace App\Http\Controllers;

use App\Models\Choir;
use App\Models\MassSchedule;
use App\Models\MinistrySchedule;
use Illuminate\Http\Request;

class MinistryScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Choir::find($input['choir_id'])->user_id;
        // $userId = Choir::find($input['choir_id'])->user_id;
        // dd($input);
        // dd($request->all());


        MinistrySchedule::create($input);

        return redirect()->route('mass_schedules_all.index')
            ->with('schedule-updated-message', 'Minister Schedule created successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return \Illuminate\Http\Response
     */
    public function show(MinistrySchedule $ministrySchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(MinistrySchedule $ministrySchedule)
    {
        // dd($ministrySchedule->massSchedule->mass_title);
        return view('admin.ministry_schedules.edit', [
            'ministrySchedule' => $ministrySchedule,
            'choirs' => Choir::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MinistrySchedule $ministrySchedule)
    {
        $input = $request->all();
        $input['user_id'] = Choir::find($input['choir_id'])->user_id;

        $ministrySchedule->update($input);
        return redirect()->route('mass_schedules_all.index')
            ->with('schedule-updated-message', 'Minister Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(MinistrySchedule $ministrySchedule)
    {
        //
    }

    public function createByMassSchedule(MassSchedule $schedule)
    {
        // dd($schedule->id);
        // return view('admin.choir_members.create_by_parent', ['schedule' => $schedule]);

        return view('admin.ministry_schedules.create_by_mass_schedule', [
            'schedule' => $schedule,
            'choirs' => Choir::all()
        ]);
    }

    public function fillByMassSchedule(MassSchedule $schedule)
    {
        $ministrySchedule = MassSchedule::find($schedule->id)->ministrySchedule;
        if ($ministrySchedule) {
            $view = $this->edit($ministrySchedule);
            return $view;
        } else {
            $view = $this->createByMassSchedule($schedule);
            return $view;
        }
    }
}
