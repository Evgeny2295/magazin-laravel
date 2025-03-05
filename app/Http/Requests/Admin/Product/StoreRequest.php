<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string',
            'description'=>'required|string',
            'price'=>'required|integer',
            'old_price'=>'nullable|integer',
            'strength'=>'required|integer',
            'capacity'=>'required|numeric',
            'country'=>'required|string',
            'count'=>'required|integer',
            'status'=>'required|integer',
            'category_id'=>'required|integer',
            'img'=>'required|file',
        ];
    }

}
