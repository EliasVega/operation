<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperationRemissionRequest extends FormRequest
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
            'price'        => '',
            'subtotal'     => '',
            'item'         => '',
            'pending'      => '',
            'operation_id' => '',
            'remission_id' => ''
        ];
    }
}
