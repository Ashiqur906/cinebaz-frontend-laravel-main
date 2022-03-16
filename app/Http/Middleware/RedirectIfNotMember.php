<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'member')
    {
        if (!auth()->guard($guard)->check()) {
            $request->session()->flash('error', 'You must to see this page');
            return redirect(route('member.auth.showlogin'));
        }
        return $next($request);
    }
}
