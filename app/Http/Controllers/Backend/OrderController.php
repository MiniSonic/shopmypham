<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Brand;
use App\Model\Entities\Category;
use App\Model\Entities\Order;
use App\Model\Entities\Product;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use Illuminate\Support\Facades\File;

class OrderController extends BackendController
{
    public function __construct(OrderRepository $orderRepository)
    {
        $this->setRepository($orderRepository);
    }

    public function index()
    {
        $entities = Order::delFlagOn()->orderBy('id', 'desc')->with('user')->paginate(getBackendPagination());

        $viewData = [
            'entities' => $entities
        ];

        return view('backend.order.index', $viewData);
    }

    public function show($id)
    {
        try {
            $entity = Order::delFlagOn()->with('orderDetails')->where('id', $id)->first();

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity
            ];

            return view('backend.order.show', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function edit($id)
    {
        try {
            $entity = Order::delFlagOn()->where('id', $id)->first();

            if (empty($entity)) {
                return backSystemError();
            }

            if ($entity->status != getConfig('order-status-new')) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity,
            ];

            return view('backend.order.edit', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function update($id)
    {
        try {
            $entity = Order::delFlagOn()->where('id', $id)->first();
            $entity->status = request('status');
            $entity->save();

            return backRouteSuccess('backend.order.index', transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }
}
