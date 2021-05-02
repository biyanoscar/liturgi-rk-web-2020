<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChoirMember extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ministrySchedule()
    {
        return $this->belongsToMany(MinistrySchedule::class);
    }

    /**
     * Get the choir that owns the member.
     */
    public function choir()
    {
        return $this->belongsTo(Choir::class);
    }

    public function getChoirMembersMinistry($ministryScheduleId)
    {
        $members = DB::table('choir_member_ministry_schedule AS a')
            ->join('choir_members', 'a.choir_member_id', '=', 'choir_members.id')
            ->select('*')
            ->where('ministry_schedule_id', '=', $ministryScheduleId)
            ->get();
        return $members;
    }
}
