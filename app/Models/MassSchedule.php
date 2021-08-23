<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Blameable;

class MassSchedule extends Model
{
    use HasFactory;
    use Blameable;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function getScheduleTimeAttribute($value)
    // {
    //     // return Carbon::parse($value)->format('d M H:i');
    //     return Carbon::parse($value)->isoFormat('D MMM Y');
    // }

    /**
     * Get the ministry schedules associated with the mass schedules.
     */
    public function ministrySchedule()
    {
        return $this->hasOne(MinistrySchedule::class);
    }
}
