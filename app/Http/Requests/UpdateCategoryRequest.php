<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        'image' => 'image|nullable',
        'parent_id' => 'required|numeric'
      ];
    }
    public function messages()
    {
      return [
        'name.required' => 'Tên danh mục không hợp lệ',
        'name.min' => 'Tên danh mục không hợp lệ',
        'name.not_regex' => 'Tên danh mục không hợp lệ',

        'image.image' => 'Hình ảnh không hợp lệ',
        
        'parent_id.required' => 'Tên không hợp lệ',
        'parent_id.numeric' => 'Tên không hợp lệ'
      ];
    }
}
