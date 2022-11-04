<?php

namespace App\Http\Controllers;

use App\Models\Job_Seeker;
use App\Models\UserModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function getForm()
    {
        return view('login');
    }

    function signIn(Request $req)
    {

        //$js = new Job_Seeker();
        $u = new UserModel();
        $login = $u->where('uname', $req->unmail)->where('pass', $req->pass)->first();
        $loginWithMail = $u->where('mail', $req->unmail)->where('pass', $req->pass)->first();
        if (!empty($login)) {
            session()->put("uid", $login->id);
            return redirect()->to('/dashboard');
        } else if (!empty($loginWithMail)) {
            session()->put("uid", $loginWithMail->id);
            return redirect()->to('/dashboard');
        } else {
            return view('login')->with('err', 'User or not found or Invalid credentials. Please try again');
        }
    }

    function logOut()
    {
        session()->flush();
        return redirect()->to('/login');
    }
}
