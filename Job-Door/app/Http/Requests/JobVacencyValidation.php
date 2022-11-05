<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacencyValidation extends FormRequest
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
            'jtitle' => 'required|max:20',
            'jtype' => 'required',
            'jdesc' => 'required|max:500',
            'salary' => 'required|alpha_dash',
            'addr' => 'required|max:200',
            'jltype' => 'required',
            'vcount' => 'integer|required|between:1,100',
            'cname' => 'required|max:50',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'This feild is required',
            'jtitle.max' => 'Title can be maximum of 200 character',
            'jdesc.max' => 'Job description can be maximum 500 characters',
            'salary.alpha_dash' => 'Salary can be digits, text or dashes and underscores',
            'addr.max' => 'Address can be maximum of 200 characters',
            'vcount.integer' => 'Vacency must be a number',
            'vcount.between' => 'Vacency can have 3 digts max',
            'cname' => 'Company Name must be of max 50 characters'
        ];
    }
}
