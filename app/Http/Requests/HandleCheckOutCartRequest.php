<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleCheckOutCartRequest extends FormRequest
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
            "receive_name" => "required",
            "receive_email" => "required|email",
            "receive_phone" => "required",
            "receive_city" => "required",
            "receive_address" => "required",
            'contents' => 'required'
        ];
    }
}
