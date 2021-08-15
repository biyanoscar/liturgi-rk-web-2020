<?php
namespace App\Repositories;

use App\Models\Choir;
use App\Models\ChoirMember;
use Illuminate\Http\Request;
use App\Models\MinistrySchedule;
use App\Repositories\AppRepository;
use Illuminate\Support\Facades\DB;

class MinistrySchedulesRepository extends AppRepository
{
    protected $model;
    
    public function __construct(MinistrySchedule $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model;
        $item->fill($data);
        $item->save();

        $this->attachChoirMembersToSchedule($data, $item);

        return $item;
    }

    public function update($id, Request $request)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model->findOrFail($id);
        $item->fill($data);
        $item->save();

        //delete anggota koor lama yg bertugas
        DB::table('choir_member_ministry_schedule')->where('ministry_schedule_id', '=', $item->id)->delete();
        
        $this->attachChoirMembersToSchedule($data, $item);

        return $item;
    }
    
    /**
     * set payload data for posts table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return [
            'mass_schedule_id' => $request->input('mass_schedule_id'),
            'choir_id' => $request->input('choir_id'),
            'user_id' => Choir::findOrFail($request->input('choir_id'))->user_id,
            'organist_id' => $request->input('organist_id'),
        ];
    }

    //tiap anggota koor default diattach ke jadwal tugas
    private function attachChoirMembersToSchedule($data, $ministrySchedule)
    {
        //get data anggota koor default
        $choirMembers = ChoirMember::where('choir_id', $data['choir_id'])
            ->where('is_default', '=', 1)
            ->get();

        //tiap anggota koor default diattach ke jadwal tugas
        foreach ($choirMembers as $member) {
            $ministrySchedule->choirMember()->attach($member->id);
        }

        return true;
    }
}