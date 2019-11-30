<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
        'name' => 'required|min:3|not_regex:/[#!@$^&*()<>._?+-,:\/;%]/',
        'image' => 'image|nullable'
      ];
    }
    public function messages()
    {
      return [
        'name.required' => 'Trường này không được để trống',
        'name.min' => 'Tên thương hiệu không hợp lệ',
        'name.not_regex' => 'Tên thương hiệu không hợp lệ',

        'image.image'=> 'Ảnh không hợp lệ',
      ];
    }
}
