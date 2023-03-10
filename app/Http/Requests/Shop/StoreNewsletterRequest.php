<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNewsletterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_mail' => 'required|unique:newsletter,user_mail,'.$this->id,
        ];
    }
    public function attributes(): array
    {
        return [
            'user_mail' => 'ایمیل کاربر',
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
