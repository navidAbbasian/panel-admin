<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductWaterfallsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|unique:product_waterfalls,title,'.$this->id,
        ];
    }
    public function attributes(): array
    {
        return [
            'title'=> 'عنوان',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute الزامی است',
            'unique' => ':attribute نباید تکراری باشد',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()/*->first()*/
        ]));
    }
    public function failedAuthorization()
    {
        dd('failedAuthorization');
    }
}
