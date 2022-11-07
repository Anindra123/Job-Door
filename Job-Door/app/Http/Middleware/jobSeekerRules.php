<?php

namespace App\Http\Middleware;

use App\Models\UserModel;
use Closure;
use Illuminate\Http\Request;

class jobSeekerRules
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
        if (session()->has('uid')) {
            $u = new UserModel();
            $user = $u->where('id', session()->get('uid'))->first();
            if ($user->role === 'ADMIN') return redirect('/adminDashboard');
            if ($user->role === 'JOB PROVIDER') return redirect('/jpdashboard');
        }

        return $next($request);
    }
}
