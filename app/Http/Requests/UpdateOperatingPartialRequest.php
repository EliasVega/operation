<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperatingPartialRequest extends FormRequest
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
            'quantity'     => 'required',
            'price'        => 'required',
            'subtotal'     => 'required',
            'item'         => '',
            'status'       => '',
            'operation_id' => 'required',
            'operating_id' => 'required',
            'partial_id'   => ''
        ];
    }
}
