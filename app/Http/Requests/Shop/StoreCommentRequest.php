<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|unique:comments,username,'.$this->id,
            'comment' => 'required',
        ];
    }
    public function attributes(): array
    {
        return [
            'username'=> 'نام کاربری',
            'comment'=>'بخش نظرات'
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
