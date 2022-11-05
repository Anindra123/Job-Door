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

    function signIn()
    {

        //$js = new Job_Seeker();
        // $u = new UserModel();
        // $login = $u->where('uname', $req->unmail)->where('pass', $req->pass)->first();
        // $loginWithMail = $u->where('mail', $req->unmail)->where('pass', $req->pass)->first();
        // if (!empty($login)) {
        //     if ($login->role === "ADMIN") {
        //         session()->put("uid", $login->id);
        //         return redirect()->to('/adminDashboard');
        //     }
        //     if ($login->role === "JOB SEEKER") {
        //         session()->put("uid", $login->id);
        //         return redirect()->to('/dashboard');
        //     }
        //     if ($login->role === "JOB PROVIDER") {
        //         session()->put("uid", $login->id);
        //         return redirect()->to('/jpdashboard');
        //     }
        // } else if (!empty($loginWithMail)) {
        //     if ($loginWithMail->role === "ADMIN") {
        //         session()->put("uid", $loginWithMail->id);
        //         return redirect()->to('/adminDashboard');
        //     }
        //     if ($loginWithMail->role === "JOB SEEKER") {
        //         session()->put("uid", $loginWithMail->id);
        //         return redirect()->to('/dashboard');
        //     }
        //     if ($loginWithMail->role === "JOB PROVIDER") {
        //         session()->put("uid", $loginWithMail->id);
        //         return redirect()->to('/jpdashboard');
        //     }
        // } else {

        // }
        return view('login')->with('err', 'User or not found or Invalid credentials. Please try again');
    }

    function logOut()
    {
        session()->flush();
        return redirect()->to('/login');
    }
}
