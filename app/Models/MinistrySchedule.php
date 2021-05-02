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
}
