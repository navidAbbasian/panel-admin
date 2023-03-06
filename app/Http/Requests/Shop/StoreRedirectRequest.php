<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRedirectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'from_url' => 'required',
            'to_url' => 'required',

        ];
    }
    public function attributes(): array
    {
        return [
            'from_url' => 'لینک مبدا',
            'to_url'=> 'لینک مقصد',

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
