<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewProposalValidation extends FormRequest
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
            'venue' => 'required|max:50',
            'type' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'This feild is required',
            'title.max' => 'Title can be max 100 characters',
            'venue.max' => 'Venue can be max 50 characters'
        ];
    }
}
