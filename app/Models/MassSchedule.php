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

    public function entranceSong()
    {
        return $this->belongsTo(Song::class, 'entrance_song_id');
    }

    public function kyrieSong()
    {
        return $this->belongsTo(Song::class, 'kyrie_song_id');
    }

    public function gloriaSong()
    {
        return $this->belongsTo(Song::class, 'gloria_song_id');
    }

    public function offertorySong()
    {
        return $this->belongsTo(Song::class, 'offertory_song_id');
    }

    public function sanctusSong()
    {
        return $this->belongsTo(Song::class, 'sanctus_song_id');
    }

    public function lordsPrayerSong()
    {
        return $this->belongsTo(Song::class, 'lords_prayer_song_id');
    }

    public function agnusDeiSong()
    {
        return $this->belongsTo(Song::class, 'agnus_dei_song_id');
    }

    public function communionSong()
    {
        return $this->belongsTo(Song::class, 'communion_song_id');
    }

    public function communionSong2nd()
    {
        return $this->belongsTo(Song::class, 'communion_song_2nd_id');
    }

    public function songOfPraise()
    {
        return $this->belongsTo(Song::class, 'song_of_praise_id');
    }

    public function recessionalSong()
    {
        return $this->belongsTo(Song::class, 'recessional_song_id');
    }

    public function song01()
    {
        return $this->belongsTo(Song::class, 'song_01_id');
    }

    public function song02()
    {
        return $this->belongsTo(Song::class, 'song_02_id');
    }

    public function song03()
    {
        return $this->belongsTo(Song::class, 'song_03_id');
    }

    public function song04()
    {
        return $this->belongsTo(Song::class, 'song_04_id');
    }

    public function song05()
    {
        return $this->belongsTo(Song::class, 'song_05_id');
    }

    public function getScheduleTimeFormatted($format='dddd, D MMM Y HH:mm')
    {
        return Carbon::parse($this->schedule_time)->isoFormat($format);
    }

    public function getChoirNameAttribute()
    {
        return (isset($this->ministrySchedule->choir_id)) ? $this->ministrySchedule->choir->name : '';
    }
}
