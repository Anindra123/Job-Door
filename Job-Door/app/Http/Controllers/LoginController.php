<?php

namespace App\Http\Controllers;

use App\Models\Job_Seeker;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function getForm(Request $req)
    {

        return view('login');
    }

    function signIn(Request $request)
    {
        $credentials = $request->only('unmail', 'pass');


        $authenticated = (Auth::attempt([
            'name' => $credentials['unmail'],
            'password' => $credentials['pass']
        ]) || Auth::attempt([

            'email' => $credentials['unmail'],
            'password' => $credentials['pass']
        ]));

        // dd($authenticated);
        if ($authenticated === true) {
            $uname = $request->input('unmail');
            $password = $request->input('pass');
            $u = new User();
            $u_role = new UserModel();
            $login = $u->where('name', $uname)->first();
            $loginWithMail = $u->where('email', $uname)->first();


            $uname = ($login->name ?? $loginWithMail->name);
            $pass = ($login->password ?? $loginWithMail->password);
            if (!isset($uname) || !isset($pass)) return next($request);

            $checkPass = Hash::check($password, $pass);
            if ($checkPass === false) return next($request);

            $urole = $u_role->where('uname', $uname)->first();


            if (!empty($login)) {
                if ($urole->role === "ADMIN") {
                    $request->session()->regenerate();
                    session()->put("uid", $login->id);
                    return redirect()->intended('/adminDashboard');
                }
                if ($urole->role === "JOB SEEKER") {
                    $request->session()->regenerate();
                    session()->put("uid", $login->id);
                    $token = $login->createToken($login->name);
                    Cookie::queue(Cookie::make('token', $token->accessToken->token));
                    return redirect()->intended('/dashboard');
                }
                if ($urole->role === "JOB PROVIDER") {
                    $request->session()->regenerate();
                    session()->put("uid", $login->id);
                    $token = $login->createToken($login->name);
                    Cookie::queue(Cookie::make('token', $token->accessToken->token));
                    return redirect()->intended('/jpdashboard');
                }
            } else {
                if ($urole->role === "ADMIN") {
                    $request->session()->regenerate();
                    session()->put("uid", $loginWithMail->id);
                    return redirect()->intended('/adminDashboard');
                }
                if ($urole->role === "JOB SEEKER") {
                    $request->session()->regenerate();
                    session()->put("uid", $loginWithMail->id);
                    $token = $login->createToken($login->name);
                    Cookie::queue(Cookie::make('token', $token->accessToken->token));
                    return redirect()->intended('/dashboard');
                }
                if ($urole->role === "JOB PROVIDER") {
                    $request->session()->regenerate();
                    session()->put("uid", $loginWithMail->id);
                    $token = $login->createToken($login->name);
                    Cookie::queue(Cookie::make('token', $token->accessToken->token));
                    return redirect()->intended('/jpdashboard');
                }
            }
        } else {
            return view('login')->with('err', 'User or not found or Invalid credentials. Please try again');
        }
        // return $next($request);
        // if () {
        // dd('found');
        // }
        //$js = new Job_Seeker();
        // $u = new UserModel();
        // $login = $u->where('uname', $req->unmail)->where('pass', $req->pass)->first();
        // $loginWithMail = $u->where('mail', $req->unmail)->where('pass', $req->pass)->first();


    }

    function logOut()
    {
        // dd(cookie('token'));
        if (Cookie::has('token')) {
            Cookie::queue(Cookie::forget('token'));
        }
        if (Cookie::has('XSRF-TOKEN')) {
            Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        }
        $uid = session('uid');
        $u = new User();
        $user = $u->where('id', $uid)->first();
        $user->tokens()->delete();
        session()->flush();
        return redirect()->to('/login');
    }
}
