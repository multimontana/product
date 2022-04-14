<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'details' => 'nullable|required',
            'description' => 'string|required',
            'price' => 'required|numeric',
            'is_published' => 'nullable|boolean',
            'category_ids' => 'required|array|min:2|max:10'
        ];
    }
}
