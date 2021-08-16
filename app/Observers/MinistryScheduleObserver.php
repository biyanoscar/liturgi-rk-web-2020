<?php

namespace App\Observers;

use App\Models\MinistrySchedule;
use Illuminate\Support\Facades\Auth;

class MinistryScheduleObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    public function creating(MinistrySchedule $ministrySchedule)
    {
        $ministrySchedule->created_by = Auth::user()->id;
        $ministrySchedule->updated_by = Auth::user()->id;
    }

    public function updating(MinistrySchedule $ministrySchedule)
    {
        $ministrySchedule->updated_by = Auth::user()->id;
    }
    
    /**
     * Handle the MinistrySchedule "created" event.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return void
     */
    public function created(MinistrySchedule $ministrySchedule)
    {
        //
    }

    /**
     * Handle the MinistrySchedule "updated" event.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return void
     */
    public function updated(MinistrySchedule $ministrySchedule)
    {
        //
    }

    /**
     * Handle the MinistrySchedule "deleted" event.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return void
     */
    public function deleted(MinistrySchedule $ministrySchedule)
    {
        //
    }

    /**
     * Handle the MinistrySchedule "restored" event.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return void
     */
    public function restored(MinistrySchedule $ministrySchedule)
    {
        //
    }

    /**
     * Handle the MinistrySchedule "force deleted" event.
     *
     * @param  \App\Models\MinistrySchedule  $ministrySchedule
     * @return void
     */
    public function forceDeleted(MinistrySchedule $ministrySchedule)
    {
        //
    }
}
