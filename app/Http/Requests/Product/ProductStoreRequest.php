<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ProductStoreRequest extends FormRequest
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
            'unit_price' => ['required', 'numeric'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'height' => ['required', 'numeric'],
            'width' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'size' => ['required', 'numeric'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
