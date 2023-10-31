<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Site\Auth\UpdatePersonalRequest;
use App\Models\User;
use App\Services\Site\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('site', ['only' => ['personal', 'updatePersonal']]);

        $this->userService = $userService;
    }

    public function personal()
    {
        $user = User::where('id', Auth::guard('site')->user()->id)->first();

        return view('pages.site.personal', compact('user'));
    }

    public function updatePersonal(UpdatePersonalRequest $request)
    {
        $user = User::where('id', Auth::guard('site')->user()->id)->first();
        $this->userService->update($request, $user);

        return redirect()->back()->with('success-notification', 'Cập nhật thông tin thành công');
    }
}
