<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addUserRequest extends FormRequest
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
            // 'firstName' => 'required',
            // 'lastName' => 'required',
            'email' => 'required',
            'password' => 'required',
            'tcoin' => 'required|numeric|min:0',
        
            'isadmin' => 'required',
            'isactive' => 'required',
            // 'phone' => 'required',
            // 'facebook' => 'required',
            

        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Opps!!! Email đã tồn tại trong hệ thống',
            'numeric' =>':attribute Chỉ có thể nhập số',
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
           
        ];
    }
}
