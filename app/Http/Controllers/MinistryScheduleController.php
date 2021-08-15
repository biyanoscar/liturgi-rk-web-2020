<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Choir;
use App\Models\Organist;
use App\Models\ChoirMember;
use App\Models\MassSchedule;
use Illuminate\Http\Request;
use App\Models\MinistrySchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\MinistrySchedulesRepository;

class MinistryScheduleController extends Controller
{
    protected $repository;

    public function __construct(MinistrySchedulesRepository $repository)
    {
        $this->repository = $repository;
    }

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
        try {
            $item = $this->repository->store($request);
            
            return redirect()->route('mass_schedules_all.index')
                ->with('schedule-updated-message', 'Minister Schedule created successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->__toString());

            return redirect()->route('mass_schedules_all.index')
                ->with('schedule-deleted', $e->getMessage());
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return \Illuminate\Http\Response
     */
    public function show(MinistrySchedule $ministrySchedule)
    {
        return view('admin.ministry_schedules.show', [
            'ministrySchedule' => $ministrySchedule,
            'choirMembers' => Choir::find($ministrySchedule->choir_id)->choirMembers

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(MinistrySchedule $ministrySchedule)
    {
        return view('admin.ministry_schedules.edit', [
            'ministrySchedule' => $ministrySchedule,
            'choirs' => Choir::all(),
            'organists' => Organist::all(),
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
        try {
            $item = $this->repository->update($ministrySchedule->id, $request);

            return redirect()->route('mass_schedules_all.index')
                ->with('schedule-updated-message', 'Minister Schedule updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->__toString());

            return redirect()->route('mass_schedules_all.index')
                ->with('schedule-deleted', $e->getMessage());
        }
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
        return view('admin.ministry_schedules.create_by_mass_schedule', [
            'schedule' => $schedule,
            'choirs' => Choir::all(),
            'organists' => Organist::all(),
        ]);
    }

    //buka form create/edit tergantung apakah data ada/tdk
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

    public function attachChoirMember(MinistrySchedule $ministrySchedule)
    {
        $membersOnDutyCounts = $ministrySchedule->getChoirMemberCounts();
        if ($membersOnDutyCounts >= 5) {
            session()->flash('msg-error', 'Sorry. Kursinya ga cukup bosss!!!');
            return redirect()->back()->withInput();
        }
        // dd(count($ministrySchedule->choirMember));

        $ministrySchedule->choirMember()->attach(request('choir_member'));
        session()->flash('msg-success', 'Anggota berhasil ditugasin');
        return back();
    }

    public function detachChoirMember(MinistrySchedule $ministrySchedule)
    {
        $ministrySchedule->choirMember()->detach(request('choir_member'));
        session()->flash('msg-error', 'Anggota berhasil diliburin');
        return back();
    }
}
