<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DriveLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id =($this->drive_link) ? $this->drive_link->id : '' ;
        return [
            'name' => [
                'required',
                Rule::unique('drive_links')->ignore($id),
            ],
            'link_id' => 'required',
        ];
    }
}
