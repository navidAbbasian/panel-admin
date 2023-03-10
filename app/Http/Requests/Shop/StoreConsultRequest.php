<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreConsultRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:consult,name,'.$this->id,
            'user_id' => 'required|unique:consult,user_id,'.$this->id,

        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'نام',
            'user_id'=> 'شناسه کاربر',

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
