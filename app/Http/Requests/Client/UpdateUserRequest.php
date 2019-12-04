<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'avatar'=> 'image|nullable',
            'phone_number'=> 'min:3|numeric|nullable',
            'address'=> 'not_regex:/[#!@$^&*<>._?+,:;%]/|max:100|nullable',
            'city'=> 'not_regex:/[#!@$^&*<>._?+,:;%]/|max:50|nullable',
            'description'=> 'not_regex:/[#!@$^&*<>._?+,:;%]/|nullable',
            'date_of_birth'=> 'date|before:today|nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống',
            'name.not_regex' => 'Tên không hợp lệ',
            
            'avatar.required'=> 'Trường này không được để trống',
            'avatar.image'=> 'Ảnh không hợp lệ',

            'phone_number.numeric'    => 'Số điện thoại không hợp lệ ',
            'phone_number.min'    => 'Số điện thoại không hợp lệ ',

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
