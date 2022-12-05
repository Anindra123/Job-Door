<?php

namespace App\Http\Requests;

use App\Rules\SkillRule;
use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
            'skillsList' => ['required', 'max:100', new SkillRule],
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
            'skillsList.required' => 'This feild cannot be empty',
            'skillsList.max' => 'This feild can have maximum 100 characters',
        ];
    }
}
