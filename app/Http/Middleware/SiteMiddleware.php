<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SiteMiddleware
{
    public function __construct()
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'site'): Response
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('site.home')->with('error-notification', 'Vui lòng đăng nhập');
        }
        if (Auth::guard($guard)->user()->status == 'blocked') {
            Auth::guard($guard)->logout();
            return redirect()->route('site.home')->with('error-notification', 'Tài khoản của bạn đã bị cấm sử dụng');
        }

        return $next($request);
    }
}
