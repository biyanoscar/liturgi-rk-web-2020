<?php

namespace App\Actions;

use App\Models\MassSchedule;

class InsertMassSchedule
{
    public function __invoke(array $data): MassSchedule
    {
        return MassSchedule::create([
            'schedule_time' => $data['date']->format('Y-m-d') . $data['hour'],
            'mass_title' => 'Misa ' . $data['date']->isoFormat('D MMM'),
            'is_daily_mass' => $data['is_daily_mass'],
            'user_id' => $data['user_id'],
            'show_gloria' => $data['show_gloria'],
        ]);
    }
}
