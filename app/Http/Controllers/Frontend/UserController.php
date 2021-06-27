<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\Order;
use App\Model\Entities\OrderDetail;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\File;

class UserController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function account()
    {
        $user = frontendCurrentUser();
        $viewData = [
            'user' => $user
        ];
        return view('frontend.tai-khoan', $viewData);
    }

    public function orderHistory()
    {
        $order = Order::delFlagOn()->where('user_id', frontendCurrentUserId())->orderBy('id', 'desc')->get();

        $viewData = [
            'order' => $order
        ];

        return view('frontend.lich-su-mua-hang', $viewData);
    }

    public function orderDetail($id)
    {
        $order = Order::delFlagOn()->where('id', $id)->first();
        $orderDetail = OrderDetail::with('product')->where('order_id', $id)->get();

        $viewData = [
            'orderDetail' => $orderDetail,
            'order' => $order,
        ];

        return view('frontend.chi-tiet-don-hang', $viewData);
    }

    public function updateStatusOrder($id)
    {
        $order = Order::delFlagOn()->where('id', $id)->first();

        if (empty($order)) {
            abort(404);
        }

        $viewData = [
            'order' => $order
        ];

        return view('frontend.cap-nhat-don-hang', $viewData);
    }

    public function updateStatusOrderPost($id)
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateStoreOrder($params);

            if (!$isValid) {
                return redirect()->back()->withErrors($validator->errors())->withInput($params);
            }

            $order = Order::delFlagOn()->where('id', $id)->first();

            if (empty($order)) {
                return backSystemError();
            }

            $order->fill($params);
            $order->save();

            return backRouteSuccess(frontendRouterName('account.order.history'), transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function updateAccount()
    {
        try {
            $entity = frontendCurrentUser();
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateStoreUser($params, frontendCurrentUserId());

            if (!$isValid) {
                return redirect()->back()->withInput($params)->withErrors($validator->errors());
            }

            if (!arrayGet($params, 'password')) {
                unset($params['password']);
            } else {
                $params['password'] = bcrypt($params['password']);
            }

            $entity->fill($params);
            $entity->save();
            return backSuccess(transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }
}
