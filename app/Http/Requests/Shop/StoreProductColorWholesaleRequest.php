<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductColorWholesaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'price' => 'required',
        ];
    }
    public function attributes(): array
    {
        return [
            'price'=> 'قیمت',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute الزامی است',
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
