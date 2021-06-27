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
@endpush

@section('content')

    <div class="cart-page">
        <div id="wrapper" class="wp-inner clearfix">

            @if (count($order) > 0)
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        @include('layouts.frontend.structures._notification')
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>STT</td>
                                    <td>Mã đơn hàng</td>
                                    <td>SĐT</td>
                                    <td>Tên người nhận</td>
                                    <td>Địa chỉ nhận</td>
                                    <td>Thành tiền (VNĐ)</td>
                                    <td>Trạng thái</td>
                                    <td>Hành động</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $key => $item)
                                <tr>
                                    <td>{{ 1 + $key }}</td>
                                    <td>#{{ $item->id }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ formatPriceCurrency($item->total_money) }}</td>
                                    <td>{!! getOrderStatus($item->status)  !!}</td>
                                    <td>
                                        <a class="text-danger" href="{{ frontendRouter('account.order.detail', ['id' => $item->id]) }}"><i class="fa fa-eye"></i></a> &nbsp
                                        @if ($item->status == getConfig('order-status-new'))
                                            <a class="text-danger" href="{{ frontendRouter('account.order.update', ['id' => $item->id]) }}"><i class="fa fa fa-edit"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <a href="{{ frontendRouter('home') }}" title="mua tiếp" id="buy-more" class="text-danger">Mua tiếp</a><br>
                    </div>
                </div>
            @else
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title"><strong>Bạn chưa có đơn hàng nào.</strong></p>
                    </div>
                </div>

                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <a href="{{ frontendRouter('home') }}" title="mua tiếp" id="buy-more">Mua hàng</a><br>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
