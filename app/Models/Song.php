<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Blameable;

class Song extends Model
{
    use HasFactory;
    use Blameable;
    protected $guarded = [];
}
