<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'stitle' => 'required|max:20',
            'servicedesc' => 'required|max:500',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'This field is required',
            'stitle.max' => 'Service title can be max 20 character',
            'servicedesc.max' => 'Service description can be 500 characters long'
        ];
    }
}
