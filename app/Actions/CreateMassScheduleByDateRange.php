<?php

namespace App\Actions;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Validator;

class CreateMassScheduleByDateRange
{
    private $insertMassSchedule;

    public function __construct(InsertMassSchedule $insertMassSchedule)
    {
        $this->insertMassSchedule = $insertMassSchedule;
    }

    public function __invoke(array $data)
    {
        $data = Validator::validate($data, [
            'start_date' => ['required'],
            'end_date' => ['required'],
            'mass_type' => ['required'],
        ]);

        if (in_array($data['mass_type'], ['daily', 'all'])) {
            $this->createDailyMasses($data);
        }

        if (in_array($data['mass_type'], ['sunday', 'all'])) {
            $this->createSundayMasses($data);
        }
    }

    private function createDailyMasses(array $data)
    {
        //tanggal periode awal dan akhir ambil dari form
        $periods = CarbonPeriod::create($data['start_date'], $data['end_date']); //rentang tanggal yang diisikan misanya

        // Iterate over the period
        foreach ($periods as $date) {
            if ($date->dayOfWeek == 0) { // skip even members
                continue;
            }

            switch ($date->dayOfWeek) {
                case 1: //'Senin'
                    $userDefault = 2;
                    break;
                case 2: //Selasa
                    $userDefault = 3;
                    break;
                case 3:
                    $userDefault = 4;
                    break;
                case 4:
                    $userDefault = 5;
                    break;
                case 5:
                    $userDefault = 6;
                    break;
                case 6:
                    $userDefault = 10;
                    break;
                default:
                    $userDefault = 1;
            }

            $this->createSchedule($date, ' 06:00', 1, $userDefault, 0);
        }
    }

    private function createSundayMasses(array $data)
    {
        //tanggal periode awal dan akhir ambil dari form
        $periods = CarbonPeriod::create($data['start_date'], $data['end_date']); //rentang tanggal yang diisikan misanya

        // Iterate over the period
        foreach ($periods as $date) {
            if ($date->dayOfWeek == 0) {
                //misa hari minggu
                $sundayMassTimes = config('general.mass_times.sunday');
                foreach ($sundayMassTimes as $massTime) {
                    $this->createSchedule($date, ' '. $massTime, 0, 1);
                }
            } elseif ($date->dayOfWeek == 6) {
                //misa hari sabtu
                $this->createSchedule($date, ' 17:30', 0, 1);
            }
        }
    }

    //function untuk insert jadwal misa. $hour -> format jam, misal 08:00
    //isDailyMass=1 -> misa harian
    private function createSchedule($date, $hour, $isDailyMass, $userId, $showGloria = 1)
    {
        ($this->insertMassSchedule)([
            'date' => $date,
            'hour' => $hour,
            'is_daily_mass' => $isDailyMass,
            'user_id' => $userId,
            'show_gloria' => $showGloria,
        ]);
    }
}
