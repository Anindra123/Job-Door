<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        if ($urole->role === "ADMIN") {
            session()->put("uid", $login->id);
            return redirect()->to('/adminDashboard');
        }
        if ($urole->role === "JOB SEEKER") {
            session()->put("uid", $login->id);
            return redirect()->to('/dashboard');
        }
        if ($urole->role === "JOB PROVIDER") {
            session()->put("uid", $login->id);
            return redirect()->to('/jpdashboard');
        }

        return $next($request);
    }
}
