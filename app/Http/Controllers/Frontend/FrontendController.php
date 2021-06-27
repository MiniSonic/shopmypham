<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController as BaseFrontendController;
use App\Model\Entities\Category;
use App\Model\Entities\Order;
use App\Model\Entities\OrderDetail;
use App\Model\Entities\Product;
use App\Model\Entities\Cart;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class FrontendController extends BaseFrontendController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function index()
    {
        $productHot = Product::delFlagOn()->where('hot', getConfig('product-hot'))->take(8)->get();
        $category = Category::delFlagOn()->where('level', 1)->get();
        $data = [];

        foreach ($category as $key => $value) {
            $dataProduct = Product::with('category')->delFlagOn()->where('category_id', $value->id)->take(4)->get();

            array_push($data, $dataProduct);
        }

        $viewData = [
            'productHot' => $productHot,
            'data' => $data
        ];

        return view('frontend.index', $viewData);
    }

    public function gioiThieu()
    {
        return view('frontend.gioi-thieu');
    }

    public function lienHe()
    {
        return view('frontend.lien-he');
    }

    public function sanPham($id)
    {
        $product = Product::delFlagOn()->with('category')->where('id', $id)->first();

        if (empty($product)) {
            abort(404);
        }

        $relationProduct = Product::delFlagOn()->where('id', '!=', $id)->where('category_id', $product->category_id)->take(4)->get();

        $viewData = [
            'product' => $product,
            'relationProduct' => $relationProduct,
        ];

        return view('frontend.san-pham', $viewData);
    }

    public function danhSachDanhMuc()
    {
        return view('frontend.danh-muc');
    }

    public function showDanhMuc($id)
    {
        $category = Category::delFlagOn()->where('id', $id)->first();
        if (empty($category)) {
            abort(404);
        }
        $query = Product::delFlagOn()->where('category_id', $id);

        $params = request()->all();

        if (arrayGet($params, 'ram')) {
            $query->where('ram', arrayGet($params, 'ram'));
        }

        if (arrayGet($params, 'cpu')) {
            $query->where('cpu', arrayGet($params, 'cpu'));
        }

        if (arrayGet($params, 'price')) {
            $query->orderBy('price_origin', arrayGet($params, 'price'));
        }

        $products = $query->paginate(getFrontendPagination());
        $countProducts = $query->count();
        $viewData = [
            'category' => $category,
            'products' => $products,
            'countProducts' => $countProducts,
        ];
        return view('frontend.danh-muc', $viewData);
    }

    public function gioHang()
    {
        if (!frontendCurrentUser()) {
            return redirect()->route(frontendRouterName('home'));
        }

        $userId = frontendCurrentUserId();
        $cart = Cart::where('user_id', $userId)->get();

        $totalPriceCart = 0;
        foreach ($cart as $item) {
            $tmp = $item->tryGet('product');
            if ($tmp->price_sell) {
                $totalPriceCart += $tmp->price_sell * $item->product_quantity;
            } else {
                $totalPriceCart += $item->product_quantity * $tmp->price_origin * (100 - (int)$tmp->sale) / 100;
            }

        }
        $viewData = [
            'cart' => $cart,
            'totalPriceCart' => $totalPriceCart,
        ];

        return view('frontend.gio-hang', $viewData);
    }

    public function updateGioHang()
    {
        try {
            $cartId = request('cartId');
            $method = request('method');

            $cart = Cart::where('id', $cartId)->first();
            if (empty($cart)) {
                $response = [
                    'code' => 500,
                    'message' => 'Error system'
                ];
                return response()->json($response);
            }

            if (strtolower($method) == 'asc') {
                $cart->product_quantity = $cart->product_quantity + 1;
            } else {
                $cart->product_quantity = $cart->product_quantity - 1 > 0 ? $cart->product_quantity - 1 : 1;
            }
            $cart->save();

            $response = [
                'code' => 200,
                'message' => 'Success'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            logError($e);
        }

        $response = [
            'code' => 500,
            'message' => 'Error system'
        ];

        return response()->json($response);
    }

    public function thanhToan()
    {
        if (!frontendCurrentUser()) {
            return redirect()->route(frontendRouterName('home'));
        }

        $cart = Cart::with('product')->where('user_id', frontendCurrentUserId())->get();

        if (count($cart) <= 0) {
            return redirect()->route(frontendRouterName('home'));
        }

        $totalPriceCart = 0;
        foreach ($cart as $item) {
            $tmp = $item->tryGet('product');
            if ($tmp->price_sell) {
                $totalPriceCart += $item->product_quantity * $tmp->price_sell;
            } else {
                $totalPriceCart += $item->product_quantity * $tmp->price_origin * (100 - (int)$tmp->sale) / 100;
            }

        }

        $viewData = [
            'cart' => $cart,
            'totalPriceCart' => $totalPriceCart
        ];

        return view('frontend.thanh-toan', $viewData);
    }

    public function thanhToanThanhCong()
    {
        if (!frontendCurrentUser()) {
            return redirect()->route(frontendRouterName('home'));
        }

        $order = Order::delFlagOn()->where('status', getConfig('order-status-new'))->orderBy('id', 'desc')->first();

        $viewData = [
            'order' => $order,
        ];

        return view('frontend.thanh-toan-thanh-cong', $viewData);
    }

    /**
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart($productId)
    {
        try {
            $userId = frontendCurrentUserId();
            $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
            $productQuantity = (int)request('product_quantity');
            if ($cart) {
                $cart->product_quantity += $productQuantity;
            } else {
                $cart = new Cart();
                $cart->user_id = $userId;
                $cart->product_id = $productId;
                $cart->product_quantity = $productQuantity;
            }

            $cart->save();
            return redirect()->route('frontend.gio-hang');
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function deleteItemCart($id)
    {
        try {
            $item = Cart::find($id);
            if (!empty($item)) {
                $item->delete();

                return backSystemSuccess();
            }
        } catch (\Exception $e) {

        }

        return backRouteError();
    }

    public function postCheckout()
    {
        $params = request()->all();

        /** @var \App\Validators\UserValidator $validator */
        $validator = $this->getRepository()->getValidator();
        $isValid = $validator->frontendValidateStoreOrder($params);

        if (!$isValid) {
            return redirect()->back()->withErrors($validator->errors())->withInput($params);
        }

        DB::beginTransaction();
        try {
            // save to orders table
            $dataOrder = request()->all();
            $dataOrder['user_id'] = frontendCurrentUserId();
            $dataOrder['name'] = request('name');
            $dataOrder['address'] = request('address');
            $dataOrder['phone'] = request('phone');
            $dataOrder['total_money'] = request('total_money');
            $dataOrder['status'] = getConfig('order-status-new');
            $ordersEntity = Order::create($dataOrder);
            $orderId = $ordersEntity->getKey();

            // save to order_detail table
            $cart = Cart::where('user_id', frontendCurrentUserId())->get();

            foreach ($cart as $item) {
                $product = Product::delFlagOn()->where('id', $item->product_id)->first();
                if (!empty($product)) {
                    $orderDetail['order_id'] = $orderId;
                    $orderDetail['product_id'] = $item->product_id;
                    $orderDetail['product_name'] = $product->name;
                    $orderDetail['product_price_origin'] = $product->price_origin;
                    $orderDetail['product_price_sell'] = $product->price_sell ? $product->price_sell : $product->price_origin * (100 - $product->sale) / 100;
                    $orderDetail['product_sale'] = $product->sale;
                    $orderDetail['product_quantity'] = $item->product_quantity;
                    OrderDetail::create($orderDetail);
                }
            }

            // remove cart by user id
            Cart::where('user_id', frontendCurrentUserId())->delete();

            DB::commit();
            return redirect()->route('frontend.thanh-toan-thanh-cong');
        } catch (\Exception $e) {
            logError($e);
            DB::rollback();
        }
        return redirect()->back()->with('notification_error', 'Đã có lỗi sảy ra');
    }

    public function search()
    {
        $search = request('search');
        $query = Product::delFlagOn()->where('name', 'like', "%$search%")
            ->orWhere('sort_describe', 'like', "%$search%")
            ->orWhere('price_origin', 'like', "%$search%");
        $products = $query->paginate(getFrontendPagination());
        $countProducts = $query->count();

        $viewData = [
            'products' => $products,
            'countProducts' => $countProducts,
        ];

        return view('frontend.search', $viewData);
    }
}
