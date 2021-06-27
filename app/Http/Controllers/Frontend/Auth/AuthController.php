<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends FrontendController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function showFormLogin()
    {
        if (frontendIsLogin()) {
            return redirect()->route(frontendRouterName('home'));
        }

        return view('frontend.dang-nhap');
    }

    public function postLogin()
    {
        $credentials = [
            'email' => request('email'),
            'password' => request('password'),
            'del_flag' => delFlagOn()
        ];

        $checkLogin = frontendGuard()->attempt($credentials);

        if ($checkLogin) {
            return redirect()->route(frontendRouterName('home'));
        }

        return redirect()->back()->withErrors('Email hoặc Password không chính xác')->withInput(request()->all());
    }

    public function showFormRegister()
    {
        return view('frontend.dang-ki');
    }

    public function postRegister()
    {
        DB::beginTransaction();
        try {
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateStoreUser($params);

            if (!$isValid) {
                return redirect()->back()->withErrors($validator->errors())->withInput(request()->all());
            }

            $entity = new User();
            $params['password'] = bcrypt(arrayGet($params, 'password'));
            $entity->fill($params);
            $entity->save();

            DB::commit();
            return redirect()->route(frontendRouterName('login.get'))->with(['notification_success' => transMessage('create_success')]);
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
    }

    public function logout()
    {
        frontendGuard()->logout();
        return redirect()->route(frontendRouterName('login.get'));
    }
}
