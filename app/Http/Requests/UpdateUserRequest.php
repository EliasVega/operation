<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'              => ['required', 'string', 'max:50'],
            'number'            => ['required', 'string', 'max:20'],
            'address'           => ['required', 'string', 'max:100'],
            'phone'             => ['required', 'string', 'max:20'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:6', 'confirmed'],
            'position'          => ['required', 'string', 'max:50'],
            'reference'         => ['required', 'string', 'max:20'],
            'status'            => '',
            'company_id'        => '',
            'document_id'       => 'required',
            'role_id'           => 'required',
            'bank_id'           => 'required',
            'payment_method_id' => 'required'
        ];
    }
}
