<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function massSchedules()
    {
        return $this->hasMany(MassSchedule::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($role_name)
    {
        foreach ($this->roles as $role) {
            if (Str::lower($role_name)  == Str::lower($role->name)) {
                return true;
            }
        }
        return false;
    }

    // public function setPasswordAttribute($value)
    // {
    //     if ($value)
    //         $this->attributes['password'] = bcrypt($value);
    // }


    /**
     * Get the choirs for the user.
     */
    public function choirs()
    {
        return $this->hasMany(Choir::class);
    }

    public function userHasChoir($choirId)
    {
        foreach ($this->choirs as $choir) {
            if ($choirId  == $choir->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the choirs for the user.
     */
    public function organists()
    {
        return $this->hasMany(Organist::class);
    }
}
