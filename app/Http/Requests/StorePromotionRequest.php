<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
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
            'type'=>'required',
            'code'=>'required',
            'title'=>'required',
            'description'=>'required',
            'reduction_level'=>'required',
            'banner'=>'required',
            'banner-thumbnail'=>'required',
            'finish_at'=>'required'
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'type.required' => 'Chưa nhập loại khuyễn mãi',
            'code.required'  => 'Chưa nhập mã khuyến mãi',
            'description.required'=>'Chưa nhập mô tả khuyến mãi',
            'reduction.required'=>'giảm giá không hợp lệ',
            'banner.required'=>'chưa chọn banner',
            'banner-thumbnail.required'=>'chưa chọn banner thumbnail',
            'finish_at.required'=>'chưa chọn ngày kết thúc khuyến mãi'
        ];
    }

}
