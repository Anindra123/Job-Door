<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Job_Seeker;

class RegistrationController extends Controller
{

    function getForm()
    {
        return view('registration');
    }

    function signUp(Request $req)
    {
        $this->validate($req, [
            'fname' => 'required|max:20', 'lname' => 'required|max:20', 'uname' => 'required|max:10',
            'mail' => 'required|max:50|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
            'password' => 'required|confirmed|min:8|max:10',
            'password_confirmation' => 'required|min:8|max:10',
            'curr_occup' => 'required|max:20',
        ], [
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
            'curr_occup.required' => 'Please select your current occupation'
        ]);

        $js = new Job_Seeker();

        $js->fname = $req->fname;
        $js->lname = $req->lname;
        $js->uname = $req->uname;
        $js->mail = $req->mail;
        $js->pass = $req->password;
        $js->current_occupation = $req->curr_occup;

        $js->save();
        return view('login')->with('msg', 'Registered successfully');
    }
}
