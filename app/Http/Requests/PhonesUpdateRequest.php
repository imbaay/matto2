<?php

namespace App\Http\Requests;

use App\Phone;
use Illuminate\Foundation\Http\FormRequest;

class PhonesUpdateRequest extends FormRequest
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
            'title'         => 'required',
            'slug'          => 'required|unique:phones,slug,'.$this->phone,
            'description'   => 'required',
            'nation_id'     => 'required',
            'category_id'   => 'required',
            'image_id'      => 'image|max:1000',
            'init_price'    => 'required|numeric',
            'discount_rate' => 'required|numeric|max:100',
            'quantity'      => 'required|numeric'
        ];

    }
    public function messages()
    {
        return [
            'nation_id.required'    => 'Nation field required',
            'category_id.required'  => 'Category field required',
            'image_id.image'        => 'Image type must be png, jpg, jpeg type'
        ];
    }
}
