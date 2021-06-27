<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Category;
use App\Model\Entities\Order;
use App\Model\Entities\Product;
use App\Model\Entities\User;
use App\Repositories\CategoryCourseRepository;
use App\Repositories\CoursesRepository;
use App\Repositories\LessionRepository;
use App\Repositories\NewRepository;
use App\Repositories\TeacherRepository;

class DashboardController extends BackendController
{
    public function __construct()
    {
    }

    public function index()
    {
        $countUser = User::where('del_flag', delFlagOn())->count();
        $countCategory = Category::where('del_flag', delFlagOn())->count();
        $countProduct = Product::where('del_flag', delFlagOn())->count();
        $countOrder = Order::where('del_flag', delFlagOn())->count();

        $viewData = [
            'countUser' => $countUser,
            'countCategory' => $countCategory,
            'countProduct' => $countProduct,
            'countOrder' => $countOrder,
        ];

        return view('backend.dashboard.index', $viewData);
    }
}
