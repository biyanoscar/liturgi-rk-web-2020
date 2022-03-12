<?php

namespace App\Repositories;

use App\Models\DriveLink;
use Illuminate\Http\Request;

class DriveLinkRepository extends AppRepository
{
    protected $model;

    public function __construct(DriveLink $model)
    {
        $this->model = $model;
    }

    protected function setDataPayload(Request $request)
    {
        return [
            'name' => $request->name,
            'link_id' => $request->link_id,
            'order_num' => $request->order_num,
            'active' => (isset($request->check_active)) ? 1 : 0,
        ];
    }
}
