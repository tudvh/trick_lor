<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('admin', ['except' => ['login','handleLogin']]);
    }
    public function dashboard()
    {
        $page = 'home';
        return view('pages.admin.dashboard', compact('page'));
    }
    public function login()
    {
        return view('pages.admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function handleLogin(Request $request) {
        // dd($request);
        // User::create(['username' => 'admin','password'=>bcrypt('admin'),'role' => 'admin','full_name' =>'admin']);
        if (!Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->back()->with('error', 'Đăng nhập thất bại!');
        }else{
            return redirect()->route('admin.dashboard');
        }
        
    }
}
