<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'subtotal' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'tax' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'discount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'total' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        ];
    }
}
