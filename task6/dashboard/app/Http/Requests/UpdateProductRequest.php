<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'max:1000', 'string'],
            'price' => ['required', 'numeric', 'min:1', 'max:10000000'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'status' => ['nullable', 'integer', 'min:0', 'max:1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'details' => ['nullable', 'string'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1000'],
        ];
    }
}
