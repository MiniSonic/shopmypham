<?php

// ========== FRONTEND AREA ==========
Route::group(['prefix'=>'/', 'as'=>'frontend.', 'namespace' => 'Frontend'], function(){
    Route::get('/', ['as' => 'home', 'uses' => 'FrontendController@index']);
    Route::get('/gioi-thieu', ['as' => 'gioi-thieu', 'uses' => 'FrontendController@gioiThieu']);
    Route::get('/lien-he', ['as' => 'lien-he', 'uses' => 'FrontendController@lienHe']);
    Route::get('/san-pham/{id}', ['as' => 'san-pham', 'uses' => 'FrontendController@sanPham']);
    Route::get('/danh-muc/{id}', ['as' => 'danh-muc', 'uses' => 'FrontendController@showDanhMuc']);
    Route::get('/gio-hang', ['as' => 'gio-hang', 'uses' => 'FrontendController@gioHang']);
    Route::post('gio-hang/update', ['as'    =>  'gio-hang.update', 'uses'  =>  'FrontendController@updateGioHang']);
    Route::get('/them-gio-hang/{id}', ['as' => 'them-gio-hang', 'uses' => 'FrontendController@addToCart']);
    Route::get('/cart/delete/{id}', ['as' => 'cart.delete-item', 'uses' => 'FrontendController@deleteItemCart']);
    Route::get('/thanh-toan', ['as' => 'thanh-toan', 'uses' => 'FrontendController@thanhToan']);
    Route::post('/thanh-toan', ['as' => 'thanh-toan.post', 'uses' => 'FrontendController@postCheckout']);
    Route::get('/thanh-toan-thanh-cong', ['as' => 'thanh-toan-thanh-cong', 'uses' => 'FrontendController@thanhToanThanhCong']);
    Route::get('tim-kiem', ['as' => 'tim-kiem', 'uses' => 'FrontendController@search']);

    Route::get('/dang-nhap', ['as' => 'login.get', 'uses' => 'Auth\AuthController@showFormLogin']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('/dang-ki', ['as' => 'register.get', 'uses' => 'Auth\AuthController@showFormRegister']);
    Route::post('/dang-ki', ['as' => 'register.post', 'uses' => 'Auth\AuthController@postRegister']);
    Route::get('/dang-xuat', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    Route::get('tai-khoan', ['as' => 'account', 'uses' => 'UserController@account'])->middleware('authFrontend');
    Route::get('tai-khoan/lich-su-mua-hang', ['as' => 'account.order.history', 'uses' => 'UserController@orderHistory'])->middleware('authFrontend');
    Route::post('account/update', ['as' => 'account.update.post', 'uses' => 'UserController@updateAccount']);
    Route::get('tai-khoan/don-hang/{id}', ['as' => 'account.order.detail', 'uses' => 'UserController@orderDetail'])->middleware('authFrontend');
    Route::get('tai-khoan/don-hang/{id}/update', ['as' => 'account.order.update', 'uses' => 'UserController@updateStatusOrder'])->middleware('authFrontend');
    Route::post('tai-khoan/don-hang/{id}/update', ['as' => 'account.order.update.post', 'uses' => 'UserController@updateStatusOrderPost'])->middleware('authFrontend');
});

// ========== BACKEND AREA ==========
Route::get('management/login', ['as' => 'backend.login', 'uses' => 'Backend\Auth\AuthController@showFormLogin']);
Route::post('management/login', ['as' => 'backend.login.post', 'uses' => 'Backend\Auth\AuthController@postLogin']);
Route::get('management/logout', ['as' => 'backend.logout', 'uses' => 'Backend\Auth\AuthController@logout'])->middleware('authBackend');
Route::post('management/delete-cache', ['as' => 'backend.delete-cache', 'uses' => 'Backend\BackendController@deleteCache'])->middleware('authBackend');

Route::group(['prefix'=>'management/', 'as'=>'backend.',  'namespace' => 'Backend', 'middleware' => ['authBackend']], function(){
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    // ========== Module User ==========
    Route::group(['prefix'=>'user/', 'as'=>'user.'], function(){
        Route::get('/', ['as' => 'list', 'uses' => 'UserController@index']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::post('/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
        Route::get('/change-password/{id}', ['as' => 'change-password', 'uses' => 'UserController@changePassword']);
        Route::post('/change-password/{id}', ['as' => 'change-password.post', 'uses' => 'UserController@postChangePassword']);
    });

    // ========== Module Category ==========
    Route::group(['prefix'=>'category/', 'as'=>'category.'], function(){
        Route::get('/', ['as' => 'list', 'uses' => 'CategoryController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CategoryController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CategoryController@store']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'CategoryController@edit']);
        Route::post('/{id}', ['as' => 'update', 'uses' => 'CategoryController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'CategoryController@destroy']);
        Route::get('test/{id}', ['as' => 'test', 'uses' => 'CategoryController@test']);
    });

    // ========== Module Brand ==========
    Route::resource('product', 'ProductController');
    Route::resource('order', 'OrderController');
});
// ========== END BACKEND AREA ==========


