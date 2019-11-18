<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotCensoredRequest extends FormRequest
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
            'id' => 'required|exists:products,id',
            'violation' => 'required|not_regex:/[#^&*()<>_\/]/',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Phải tồn tại đối tượng này',
            'id.exists' => 'Đối tượng này không tồn tại',
            'violation.required' => 'Vui lòng nhập lý do đễ không xác nhận kiểm duyệt',
            'violation.not_regex' => 'Vui lòng không nhập kí tự đặc biệt',
        ];
    }
}
