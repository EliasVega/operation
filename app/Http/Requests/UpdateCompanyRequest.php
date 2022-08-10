<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        return [
            'name'            => ['required', 'string', 'max:50'],
            'nit'             => ['required', 'max:12'],
            'dv'              => ['required', 'max:2'],
            'address'         => ['required', 'string', 'max:50'],
            'phone'           => ['required', 'string', 'max:12'],
            'mobile'          => ['required', 'string', 'max:12'],
            'manager'         => ['required', 'string', 'max:50'],
            'email'           => ['required', 'string', 'max:50'],
            'logo'            => [''],
            'department_id'   => ['required'],
            'municipality_id' => ['required']
        ];
    }
}
