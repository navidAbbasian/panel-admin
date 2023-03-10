<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCustomerListRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required|unique:customers_lists,title,'.$this->id,
            'customer_id' => 'required',
            'description' => 'required'
        ];
    }
    public function attributes(): array
    {
        return [
            'customer_id' => 'شناسه مشتری',
            'title'=> 'عنوان',
            'description'=>'توضیحات'
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
