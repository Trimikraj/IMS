<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemFormRequest extends FormRequest
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
            'item_name' => 'required | min:3',
            'item_description' => 'required | min:3',
            'quantity' => 'required | numeric',
            'brand' => 'required',
            'price' => 'required | numeric',
            'unit' => 'required'
        ];
    }
}
