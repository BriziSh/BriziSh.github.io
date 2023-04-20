<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [
            "prod_title"=>"required|min:3",
            "prod_description"=>"required",
            // "category_id"=>"required",
            // "subcategory_id"=>"required",
            // bej ndryshime
            "subcategories"=>"required",
            "prod_quantity"=>"required|integer|min:0",
            "prod_price"=>"required|numeric|gt:0",
            "prod_discount"=>"nullable|numeric|gt:0", 
            "prod_image"=>"mimes:jpg,png,jpeg"
        ];
    }
}
