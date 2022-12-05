<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkExpRequest extends FormRequest
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
            'wtitle' => 'required|max:50',
            'cname' => 'required|max:50',
            'workdesc' => 'required|max:200',
            'stime' => 'required|date',
            'etime' => 'required|date|after:stime'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'This feild cannot be empty',
            'wtitle.max' => 'Work title can be max 50 characters long',
            'cname.max' => 'Company name can be max 50 characters long',
            'workdesc.max' => 'Work description can be max 200 characters long',
            'stime.date' => 'Date is not in correct format',
            'etime.date' => 'Date is not in correct format',
            'etime.after' => 'End time must be greater than start time',
        ];
    }
}
