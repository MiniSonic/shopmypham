<?php

namespace App\Composers;

use App\Model\Entities\Cart;
use App\Model\Entities\Category;
use App\Model\Entities\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view)
    {
        $categories = Category::with('children')->delFlagOn()->get();
        $numberItemInCart = 0;
        if (frontendCurrentUserId()) {
            $numberItemInCart = Cart::where('user_id', frontendCurrentUserId())->count();
        }

        $mostSellProduct = OrderDetail::delFlagOn()->with('product')->select(DB::raw("*, count('product_id') as count"))->groupBy('product_id')
            ->orderBy('count', 'desc')->take(5)->get();

        $viewDataGlobal = [
            'categories' => $categories,
            'numberItemInCart' => $numberItemInCart,
            'mostSellProduct' => $mostSellProduct,
        ];

        // bind to view
        $view->with('viewComposer', $viewDataGlobal);
    }
}
