<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choir extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the choir.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the members for the choir
     */
    public function choirMembers()
    {
        return $this->hasMany(ChoirMember::class);
    }
}
