<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartialRequest extends FormRequest
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
            'total'          => '',
            'items'          => '',
            'status'         => '',
            'aprobation'     => '',
            'payment_id'     => '',
            'user_id'        => '',
            'remission_id'   => 'required',
            'responsible_id' => ''
        ];
    }
}
