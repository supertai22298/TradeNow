<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        'old_password' => 'min:3|max:16|required',
        'new_password' => 'min:3|max:16|required',
        're_password' => 'required_with:new_password|same:new_password',
    ];
}
public function messages()
{
    return [
        'old_password.min' => 'Mật khẩu quá ngắn',
        'old_password.required' => 'Trường này không được để trống',
        'old_password.max' => 'Mật khẩu quá dài',
        
        'new_password.min' => 'Mật khẩu quá ngắn',
        'new_password.required' => 'Trường này không được để trống',
        'new_password.max' => 'Mật khẩu quá dài',

        're_password.required_with' => 'Trường này không được để trống',
        're_password.same' => 'Mật khẩu không khớp',
    ];
}
}
