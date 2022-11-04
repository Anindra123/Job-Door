<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class HandleRouteParameter
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
        $request->request->remove('id');
        // $cfg = config('route.filters');
        // var_dump($cfg);
        // // exit();
        // if (Arr::has($cfg, $request->route()->getName())) {
        //     foreach (Arr::get($cfg, $request->route()->getName()) as $arg) {

        //         $request->route()->forgetParameter($arg);
        //     }
        // }
        return $next($request);
    }
}
