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
            'salary' => 'required|digits_between:5000,1000000',
            'addr' => 'required|max:200',
            'jltype' => 'required',
            'vcount' => 'integer|required|digit:3',
        ];
    }
    public function messages()
    {
        return [

            'jtitle.max' => 'Title can be maximum of 200 character',
            'jdesc.max' => 'Job description can be maximum 500 characters',
            'salary.digits_between' => 'Salary can be minimum BDT 5000 and max BDT 1000000',
            'addr' => 'Address can be maximum of 200 characters',
            'vcount' => 'Vacency must be a nymber and can have 3 digts max',
        ];
    }
}
