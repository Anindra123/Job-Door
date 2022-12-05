<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterJobProvider;
use App\Mail\VerifyMailEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Job_Seeker;
use App\Models\JobProvider;
use App\Models\User;
use App\Models\UserModel;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{


    function getForm()
    {
        return view('registration');
    }

    function getJobProviderForm()
    {
        return view('registerJobProvider');
    }

    function signUp(Request $req)
    {
        // dd($req);
        $this->validate($req, [
            'fname' => 'required|max:20', 'lname' => 'required|max:20',
            'name' => 'required|max:10|unique:users',
            'email' => 'required|max:50|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/|unique:users',
            'password' => 'required|confirmed|min:8|max:10',
            'password_confirmation' => 'required|min:8|max:10',
            'curr_occup' => 'required|max:20',
        ], [
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
            'name.required' => 'User name is required',
            'email.required' => "Email cannot be empty",
            'email.regex' => 'Not a valid email',
            'password.required' => "Password cannot be empty",
            'password_confirmation.required' => "Confirm password cannot be empty",
            'password.confirmed' => "Password does not match. Please enter a correct password",
            'password.min' => 'Password must be atleast 8 characters and max 10 characters long',
            'password_confirmation.min' => 'Password must be atleast 8 characters and max 10 characters long',
            'password.max' => 'Password must be atleast 8 characters and max 10 characters long',
            'password_confirmation.max' => 'Password must be atleast 8 characters and max 10 characters long',
            'curr_occup.required' => 'Please select your current occupation',
            'unique' => 'A user with this mail or username already exists',

        ]);

        $js = new Job_Seeker();

        $js->fname = $req->fname;
        $js->lname = $req->lname;
        $js->current_occupation = $req->curr_occup;

        $js->save();

        $u = new UserModel();
        $u->uname = $req['name'];
        $u->mail = $req['email'];
        $u->status = 'ACTIVE';
        $u->role = 'JOB SEEKER';
        $u->profile_id = $js->id;
        $u->save();

        $user = User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => Hash::make($req['password']),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect('/verify-email');
    }


    function signUpJobProvider(RegisterJobProvider $req)
    {
        $res = $req->validated();

        $jobProvider = new JobProvider();

        $jobProvider->fname = $res['fname'];
        $jobProvider->lname = $res['lname'];
        $jobProvider->work_position = $res['work_position'];

        $jobProvider->save();

        $u = new UserModel();
        $u->uname = $res['name'];
        $u->mail = $res['email'];
        $u->status = 'ACTIVE';
        $u->role = 'JOB PROVIDER';
        $u->profile_id = $jobProvider->id;
        $u->save();


        $user = User::create([
            'name' => $res['name'],
            'email' => $res['email'],
            'password' => Hash::make($res['password']),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect('/verify-email');
    }
}
