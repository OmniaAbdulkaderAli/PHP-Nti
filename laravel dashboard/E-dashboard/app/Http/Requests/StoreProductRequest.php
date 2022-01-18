<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            
                'name_en'=>['required','string','max:100'],
                'name_ar'=>['required','string','max:100'],
                'price'=>['required','numeric','min:1','max:100000'],
                'quantity'=>['required','min:1','integer'],
                'code'=>['required','integer','digits:5','unique:products'],
                'status'=>['required','between:0,1','integer'],
                'details_en'=>['nullable','string'],
                'details_ar'=>['nullable','string'],
                'brand_id'=>['nullable','integer','exists:brands,id'],
                'subcategory_id'=>['required','integer','exists:subcategories,id'],
                'image'=>['required','max:1000','mimes:png,jpg,jpeg']

            
        ];
    }
}
