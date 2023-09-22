<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function __construct()
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,$guard = 'admin'): Response
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.login')->with('error', 'Vui lòng đăng nhập');
        } else if (Auth::guard($guard)->user()->role !== 'admin') {
            return redirect()->route('admin.login')->with('error', 'Bạn không có quyền truy cập vào trang này');
        }else if (Auth::guard($guard)->user()->active === 0 ){
            return redirect()->route('admin.login')->with('error', 'Tài khoản đã bị khóa!');

        }

        return $next($request);
    }
}
