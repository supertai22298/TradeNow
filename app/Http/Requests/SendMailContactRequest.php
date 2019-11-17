<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailContactRequest extends FormRequest
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
            'email' => 'email|required',
            'emails' => 'array|nullable',
            'emails.*' => 'email',
            'subject' => 'required|min:3',
            'description' => 'required|min:30'
        ];
    }
}
