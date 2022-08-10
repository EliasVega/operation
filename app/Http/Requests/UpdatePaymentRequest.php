<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'amount'            => '',
            'advance'           => '',
            'total'             => '',
            'reference'         => 'required',
            'bank_id'           => 'required',
            'payment_method_id' => 'required',
            'user_id'           => 'required',
            'responsible_id'    => '',
            'bank_origin-id'    => ''
        ];
    }
}
