<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|not_regex:/[0-9#!@$^&*()<>._?+-,:\/;%]/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:16',
            'avatar'=> 'required|image',
            'phone_number'=> 'numeric|min:3|nullable',
            'address'=> 'not_regex:/[#!@$^&*<>._?+,:;%]/|max:100|nullable',
            'city'=> 'not_regex:/[#!@$^&*<>._?+,:;%]/|max:50|nullable',
            'description'=> 'nullable',
            'date_of_birth'=> 'date|before:today|nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống',
            'name.not_regex' => 'Tên không hợp lệ',

            'email.email' => 'Email không hợp lệ',
            'email.required' => 'Trường này không được để trống',
            'email.unique' => 'Email đã tồn tại',

            'password.min' => 'Mật khẩu quá ngắn',
            'password.required' => 'Trường này không được để trống',
            'password.max' => 'Mật khẩu quá dài',
            
            'avatar.required'=> 'Trường này không được để trống',
            'avatar.image'=> 'Ảnh không hợp lệ',

            'phone_number.numeric'    => 'Số điện thoại không hợp lệ',
            'phone_number.min'    => 'Số điện thoại không hợp lệ',

            'address.not_regex'=> 'Địa chỉ không chứa kí tự đặc biệt',
            'address.max'=> 'Địa chỉ quá dài',

            'city.not_regex'=> 'Tên thành phố không chứa kí tự đặc biệt',
            'city.max'=> 'Tên thành phố quá dài',

            'description.not_regex'=> 'Mô tả này không được chứa kí tự đặc biệt',

            'date_of_birth.date'=> 'Ngày sinh không hợp lệ',
            'date_of_birth.before'=> 'Ngày sinh không hợp lệ',
        ];
    }
}
