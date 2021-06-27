<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends BackendController
{
    public function __construct(AdminRepository $adminRepository)
    {
        $this->setRepository($adminRepository);
    }

    public function showFormLogin()
    {
        if (backendIsLogin()) {
            return redirect()->route(backendRouterName('dashboard'));
        }

        return view('backend.auth.login');
    }

    public function postLogin()
    {
        $credentials = [
            'email' => trim(request('email')),
            'password' => trim(request('password')),
            'del_flag' => delFlagOn()
        ];

        $checkLogin = backendGuard()->attempt($credentials);

        if ($checkLogin) {
            return redirect()->route(backendRouterName('dashboard'));
        }

        return redirect()->back()->withErrors('Email hoặc Password không chính xác')->withInput(request()->all());
    }

    public function logout()
    {
        backendGuard()->logout();
        return redirect()->route(backendRouterName('login'));
    }
}