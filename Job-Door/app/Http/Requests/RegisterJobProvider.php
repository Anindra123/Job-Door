<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterJobProvider extends FormRequest
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
            'fname' => 'required|max:20', 'lname' => 'required|max:20', 'uname' => 'required|max:10',
            'mail' => 'required|max:50|email',
            'password' => 'required|confirmed|min:8|max:10',
            'password_confirmation' => 'required|min:8|max:10',
            'work_position' => 'required|max:100',

        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
            'uname.required' => 'User name is required',
            'mail.required' => "Email cannot be empty",
            'mail.regex' => 'Not a valid email',
            'password.required' => "Password cannot be empty",
            'password_confirmation.required' => "Confirm password cannot be empty",
            'password.confirmed' => "Password does not match. Please enter a correct password",
            'password.min' => 'Password must be atleast 8 characters and max 10 characters long',
            'password_confirmation.min' => 'Password must be atleast 8 characters and max 10 characters long',
            'password.max' => 'Password must be atleast 8 characters and max 10 characters long',
            'password_confirmation.max' => 'Password must be atleast 8 characters and max 10 characters long',
            'work_position.required' => 'Please select your current work position',
            'work_position.max' => 'Work Position can be maximum 100 characters'
        ];
    }
}
