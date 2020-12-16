<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterValidation extends FormRequest
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
            'name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|numeric',
            'national_code' => 'required|numeric',
            'gender' => 'required',
            'password' => 'required|min:8',

            'address' => 'required',
            'post_code' => 'required|numeric',
            'city_id' => 'required',
            'province_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن فیلد نام اجباری است.',
            'last_name.required' => 'وارد کردن فیلد نام خانوادگی اجباری است.',
            'email.required' => 'وارد کردن فیلد ایمیل اجباری است.',
            'phone.required' => 'وارد کردن فیلد شماره همراه اجباری است.',
            'national_code.required' => 'وارد کردن فیلد کد ملی اجباری است.',
            'gender.required' => 'وارد کردن فیلد جنسیت اجباری است.',
            'password.required' => 'وارد کردن فیلد رمز عبور اجباری است.',
            'address.required' => 'وارد کردن فیلد آدرس اجباری است.',
            'post_code.required' => 'وارد کردن فیلد کدپستی اجباری است.',
            'city_id.required' => 'وارد کردن فیلد شهر اجباری است.',
            'province_id.required' => 'وارد کردن فیلد استان اجباری است.',

            'name.max' => 'فیلد نام باید کمتر از 50 کاراکتر باشد.',
            'last_name.max' => 'فیلد نام خانوادگی باید کمتر از 50 کاراکتر باشد.',
            'email.email' => 'فیلد ایمیل باید دارای فرمت معتبری باشد.',
            'phone.numeric' => 'فیلد شماره همراه باید عدد باشد.',
            'national_code.numeric' => 'فیلد کدملی باید عدد باشد.',
            'post_code.numeric' => 'فیلد کدپستی باید عدد باشد.',
            'password.min' => 'فیلد پسورد باید 8 کاراکتر یا بیشتر باشد.',
        ];
    }
}
