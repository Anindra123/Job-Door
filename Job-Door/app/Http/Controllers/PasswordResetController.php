<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function get()
    {
        return view('resetPass');
    }

    public function submit(Request $req)
    {
        $this->validate($req, ['email' => 'required|email'], [
            'required' => 'Email cannot be empty',
            'email' => 'Email must be a valid mail'
        ]);

        $status = Password::sendResetLink($req->only('email'));
        // dd($status);
        return $status === Password::RESET_LINK_SENT ?
            back()->with(['msg' => $status])
            : back()->with(['err' => $status]);
    }

    public function showPassResetForm()
    {
        return view('resetPassForm');
    }
    public function submitPassReset(Request $req)
    {
        $this->validate($req, [
            'token' => 'required',
            'email' => 'required|max:50|email',
            'password' => 'required|confirmed|min:8|max:10',
        ]);

        $status = Password::reset(
            $req->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])
                    ->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ?
            redirect()->route('login')->with(['msg' => $status])
            : back()->with(['err' => $status]);
    }
}
