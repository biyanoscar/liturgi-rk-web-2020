<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistrySchedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function massSchedule()
    {
        return $this->belongsTo(MassSchedule::class);
    }

    public function choir()
    {
        return $this->belongsTo(Choir::class);
    }

    public function organist()
    {
        return $this->belongsTo(Organist::class);
    }

    public function choirMember()
    {
        return $this->belongsToMany(ChoirMember::class);
    }

    //function untuk hitung jumlah anggota koor yg tugas
    public function getChoirMemberCounts()
    {
        return count($this->choirMember);
    }
}
