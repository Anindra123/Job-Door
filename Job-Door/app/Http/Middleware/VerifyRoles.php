<?php

namespace App\Http\Middleware;

use App\Models\UserModel;
use Closure;
use Illuminate\Http\Request;

class VerifyRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uname = $request->input('unmail');
        $password = $request->input('pass');
        $u = new UserModel();
        $login = $u->where('uname', $uname)->where('pass',  $password)->first();
        $loginWithMail = $u->where('mail', $uname)->where('pass', $password)->first();
        if (!empty($login)) {
            if ($login->role === "ADMIN") {
                session()->put("uid", $login->id);
                return redirect()->to('/adminDashboard');
            }
            if ($login->role === "JOB SEEKER") {
                session()->put("uid", $login->id);
                return redirect()->to('/dashboard');
            }
            if ($login->role === "JOB PROVIDER") {
                session()->put("uid", $login->id);
                return redirect()->to('/jpdashboard');
            }
        } else if (!empty($loginWithMail)) {
            if ($loginWithMail->role === "ADMIN") {
                session()->put("uid", $loginWithMail->id);
                return redirect()->to('/adminDashboard');
            }
            if ($loginWithMail->role === "JOB SEEKER") {
                session()->put("uid", $loginWithMail->id);
                return redirect()->to('/dashboard');
            }
            if ($loginWithMail->role === "JOB PROVIDER") {
                session()->put("uid", $loginWithMail->id);
                return redirect()->to('/jpdashboard');
            }
        } else {
            return $next($request);
        }
    }
}
