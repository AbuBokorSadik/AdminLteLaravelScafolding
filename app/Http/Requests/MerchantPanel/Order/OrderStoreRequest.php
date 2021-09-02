<?php

namespace App\Http\Requests\MerchantPanel\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'email'],
            'mobile' => 'required',
            'address' => 'required',
            'address_lat' => 'nullable',
            'address_lng' => 'nullable',
            'product_weight' => 'required',
            'product_height' => 'required',
            'product_length' => 'required',
            'product_width' => 'required',
            'deadline' => 'required',
            'ref_id' => 'required',
            'amount' => 'required',
            'instruction' => 'nullable',
            'note' => 'nullable',
        ];
    }
}
