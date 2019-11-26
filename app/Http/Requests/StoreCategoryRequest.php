<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        'name' =>'required|min:3|unique:categories,name|not_regex:/[#!@$^&*()<>._?+-,:\/;%]/',
        'image' =>'image|required',
        'parent_id' => 'required|numeric'
      ];
    }
    public function messages()
    {
      return [
        'name.required' => 'Tên danh mục không hợp lệ',
        'name.min' => 'Tên danh mục không hợp lệ',
        'name.not_regex' => 'Tên danh mục không hợp lệ',
        'name.unique' => 'Tên danh mục đã tồn tại',

        'image.image' => 'Hình ảnh không hợp lệ',
        'image.required' => 'Trường này không được để trống',
        
        'parent_id.required' => 'Tên không hợp lệ',
        'parent_id.numeric' => 'Tên không hợp lệ'
      ];
    }
}
