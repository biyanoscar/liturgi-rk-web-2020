<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General Configuration
    |--------------------------------------------------------------------------
    |
    | General App Configuration
    |
    */

    //limit on the number of choir members in one schedule
    'choir_members_limit' => env('CHOIR_MEMBERS_LIMIT', 6),
    'mass_times' => [
        'sunday' => ['06:30', '09:30', '17:30'],
    ]

];
