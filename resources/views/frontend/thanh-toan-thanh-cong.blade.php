@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            width: 100%;
        }

        .sidebar {
            display: none;
        }
    </style>

    <style>
        #content-wp{
            margin: 15px 20% 20px 20%;
            text-align: center;
        }
        #content-wp p{
            font-size: 18px;
        }
        #content-wp em{
            font-size: 16px;
            display: block;
        }
        .widget{
            margin: 15px 20% 0px 20%;
            border:1px solid #dee2e6;
        }
        .wg-title{
            font-size: 16px;
            padding: 10px; text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        .wg-content li span{
            text-align: left; width: 40%;
        }
        .wg-content li strong{
            text-align: left;width: 60%;
        }
        .sub-wg-content{
            float: left;margin-left:15px;
        }
        .sub-wg-content li{
            margin-bottom: 5px; text-align: left;
        }
        .redirect a{
            color: #03bd1a;
            display: inline-block;
            padding: 15px;
            border: 1px solid #03bd1a;
        }

        @media (max-width: 768px) {
            .widget, #content-wp {
                margin: 15px 15px 0px 15px;
            }
        }
    </style>
@endpush

@section('content')

<div id="content-wp">
    <div class="d-inline-block">
        <img src="./Unimart Store_files/dau-check.png" width="80px" alt="">
    </div>
    <p>Cảm mơn quý khách đã mua hàng</p>
    <div class="widget mb-3">
        <h4 class="wg-title">Thông tin đặt hàng</h4>
        <ul class="wg-content p-3">
            <li class="clearfix">
                <span class="float-left">Mã đơn hàng</span>
                <strong class="float-right">#{{$order->id}}</strong>
            </li>
            <li class="clearfix">
                <span class="float-left">Họ tên khách hàng</span>
                <strong class="float-right">{{$order->name}}</strong>
            </li>
            <li class="clearfix">
                <span class="float-left">Só điện thoại</span>
                <strong class="float-right">{{$order->phone}}</strong>
            </li>
            <li class="clearfix">
                <span class="float-left">Địa chỉ</span>
                <strong class="float-right">{{$order->address}}</strong>
            </li>

            <li class="clearfix">
                <span class="float-left">Tổng tiền</span>
                <strong class="float-right">{{ formatPriceCurrency($order->total_money)}} VNĐ</strong>
            </li>
        </ul>
    </div>
    <div class="redirect">
        <a href="{{ frontendRouter('home') }}">Mua thêm sản phẩm khác</a>
    </div>
</div>

@endsection
