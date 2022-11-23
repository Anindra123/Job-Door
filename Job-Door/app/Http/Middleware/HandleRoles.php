<?php

namespace App\Http\Middleware;

use App\Models\UserModel;
use Closure;
use Illuminate\Http\Request;

class HandleRoles
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
        $u = new UserModel();
        if (session()->exists('uid')) {
            $user = $u->where('id', session()->get('uid'))->first();
            // dd($user);
            if ($user->role === "ADMIN") return redirect('/adminDashboard');
            if ($user->role === 'JOB SEEKER') return redirect('/dashboard');
            if ($user->role === 'JOB PROVIDER') return redirect('/jpdashboard');
        }

        return $next($request);
    }
}
