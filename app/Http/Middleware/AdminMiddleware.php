<?php

namespace App\Http\Middleware;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
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
    public function handle(Request $request, Closure $next, $guard = 'admin'): Response
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.auth.login')->with('error', 'Vui lòng đăng nhập');
        }
        if (Auth::guard($guard)->user()->status == UserStatus::BLOCKED) {
            Auth::guard($guard)->logout();
            return redirect()->route('admin.auth.login')->with('error', 'Tài khoản của bạn đã bị cấm sử dụng');
        }
        if (Auth::guard($guard)->user()->role !== UserRole::ADMIN) {
            Auth::guard($guard)->logout();
            return redirect()->route('admin.auth.login')->with('error', 'Bạn không có quyền truy cập vào trang này');
        }

        return $next($request);
    }
}
