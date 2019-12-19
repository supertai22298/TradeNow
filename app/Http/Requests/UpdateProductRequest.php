<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
          'category_id' => 'required|exists:categories,id',
          'brand_id' => 'required|exists:brands,id',
          'name' => 'required|min:3|not_regex:/[#!@$^&*()<>.?+,:\/;%]/',
          'description' =>'required|min:10',
          'price' =>'required|numeric',
          'amount' =>'required|numeric',
          'title_seo' =>'nullable|not_regex:/[#!@$^&*().?+,:;%]/',
          'description_seo' =>'nullable|not_regex:/[#!@$^&*().?+,:;%]/',
          'detail_description' => 'array|required',
          'detail_description.*' => 'required',
          'detail_type' => 'required|array', 
          'detail_type.*' => 'required',
          'image' => 'image',
          'images' => 'array',
          'images.*' => 'image',
        ];
    }

    public function messages()
    {
        return [
          'description.required' => 'Vui lòng không để trống',
          'description.min' => 'Tối thiểu 10 kí tự',
          'description.not_regex' => 'Mô tả không hợp lệ',

          'detail_description.*.min' => 'Tối thiểu 3 kí tự',
          'detail_description.*.required' => 'Vui lòng không để trống',

          'detail_type.*.min' => 'Tối thiểu 3 kí tự',
          'detail_type.*.required' => 'Vui lòng không để trống',

          'category_id.required' => 'Vui lòng nhập trường này',
          'category_id.exists' => 'Danh mục không tồn tại',

          'brand_id.required' => 'Vui lòng nhập trường này',
          'brand_idexists' => 'Thương hiệu không tồn tại',

          'name.required' => 'Vui lòng nhập trường này',
          'name.min' => 'Trường này không hợp lệ',
          'name.not_regex' => 'Trường này không hợp lệ',

          'price.required' =>'Vui lòng nhập trường này',
          'price.numeric' =>'Giá không hợp lệ',

          'amount.required' =>'Vui lòng nhập trường này',
          'amount.numeric' =>'Số lượng không hợp lệ',

          'title_seo.not_regex' =>'Tiêu đề không hợp lệ',

          'description_seo.not_regex' =>'Mô tả không hợp lệ',

          'image.image' => 'Hình ảnh không hợp lệ',

          'images.array' => 'Trường này không hợp lệ',

          'images.*.image' => 'Hình ảnh không hợp lệ',
        ];
    }
}
