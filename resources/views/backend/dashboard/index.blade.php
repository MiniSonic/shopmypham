@extends('layouts.backend.main')

@push('styles')
    <link href="/backend/css/dashboard.css" rel="stylesheet">
@endpush

@section('content')
    <div class="content-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Trang quản trị</h4>
                </div>
            </div>
        </div>



        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="margin: 15px 15px 0 15px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-cyan text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                            <h6 class="text-white">Người dùng ( {{$countUser }})</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-warning text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                            <h6 class="text-white">Danh mục sản phẩm ( {{ $countCategory }})</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-cyan text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                            <h6 class="text-white">Sản phẩm ( {{ $countProduct }}) </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-warning text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                            <h6 class="text-white">Đơn hàng ( {{ $countOrder }})</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @include('layouts.backend.structures._notification')

                        <div class="card-body__head card-body__filter text-center">
                            <a href="{{ backendRouter('logout') }}"
                               class="btn-cyan btn btn-xs modal_confirm_delete rounded"
                            >
                                Đăng xuất
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
