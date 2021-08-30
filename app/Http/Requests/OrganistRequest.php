<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganistRequest extends FormRequest
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
        $organistId =($this->organist) ? $this->organist->id : '' ;
        return [
            'name' => [
                'required',
                Rule::unique('organists')->ignore($organistId),
            ],
            'no_kk' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'name.unique' => 'Organis sudah terdaftar',
        ];
    }
}
