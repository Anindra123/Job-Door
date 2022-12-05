<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewProcessValidation extends FormRequest
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
            'title' => 'required|max:100',
            'date' => 'required',
            'stime' => 'required',
            'etime' => 'required',
            'desc' => 'required|max:500',
            'ques' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'This feild is required',
        ];
    }
}
