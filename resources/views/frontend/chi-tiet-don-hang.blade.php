@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            width: 100%;
        }

        .sidebar {
            display: none;
        }

            .orderShipping_2Lhh > div {
                flex: 1 1 50%;
                max-width: 50%;
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                flex-direction: row;
                margin-right: 1.2rem;
                margin-bottom: 0px;
                padding: 1.2rem;
                border: 1px solid rgb(232, 232, 232);
            }

        .orderShipping_2Lhh > div > div {
            flex: 1 1 50%;
            flex-direction: column;
        }

        .orderShipping_2Lhh > div > div {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .orderShipping_2Lhh {
            display: flex;
        }
    </style>
@endpush

@section('content')

    <div class="cart-page">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="orderShipping_2Lhh">
                <div class="" style="border: 1px solid rgb(232, 232, 232);">
                    <div>
                        <h3>Tình trạng vận chuyển</h3>
                        <p>Tình trạng: <strong>{!! getOrderStatus($order->status) !!}</strong></p>
                        <p>Mã vận đơn: <strong class="trackingNumber_3ikj">#{{ $order->id }}</strong></p>
                        <p>Tổng tiền: <strong class="trackingNumber_3ikj">{{ formatPriceCurrency($order->total_money) }} VNĐ</strong></p>
                    </div>
                </div>
                <div class="" style="border: 1px solid rgb(232, 232, 232);">
                    <div>
                        <h3>Thông tin nhận hàng</h3>
                        <p>Người nhận: {{ $order->name }}</p>
                        <p>Địa chỉ: {{ $order->address }}</p>
                        <p>SĐT: {{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="section" id="info-cart-wp">
                <h3>Sản phẩm</h3>
                <div class="section-detail table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <td>STT</td>
                            <td>Mã sản phẩm</td>
                            <td width="350px">Tên sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Giá tiền</td>
                            <td>Tổng tiền (VNĐ)</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetail as $key => $item)
                                <tr>
                                    <td>{{ 1 + $key }}</td>
                                    <td>#{{ $item->id}}</td>
                                    <td ><a style="color: black" href="{{ frontendRouter('san-pham', ['id' => $item->product_id]) }}">{{ $item->tryGet('product')->name }}</a></td>
                                    <td class="text-center">
                                        @if ($item->tryGet('product')->avatar)
                                            <img class="text-center" src="{{ asset($item->tryGet('product')->avatar) }}" width="100px" style="margin: 0 auto">
                                        @else
                                            <img class="text-center" src="{{ asset('image/lap-top-default.png') }}" width="100px" style="margin: 0 auto">
                                        @endif
                                    </td>
                                    <td>{{ $item->product_quantity }}</td>
                                    <td>
                                        Giá bán: {{ formatPriceCurrency($item->product_price_sell) }} <br>
                                        Sale: {{ $item->product_sale }} %<br>
                                        Giá gốc: <span style="text-decoration: line-through">{{ formatPriceCurrency($item->product_price_origin) }}</span> <br>
                                    </td>
                                    <td>{{ formatPriceCurrency($item->product_price_sell * $item->product_quantity) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5"></td>
                                <td class="bold">Tổng tiền</td>
                                <td class="text-danger bold">{{ formatPriceCurrency($order->total_money)  }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <br>

                <a href="{{ frontendRouter('account.order.history') }}" class="btn btn-danger">Quay lại danh sách đơn hàng</a>
        </div>
    </div>

@endsection
