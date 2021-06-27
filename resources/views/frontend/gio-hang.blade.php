@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            width: 100%;
        }

        .sidebar {
            display: none;
        }

        .btn-num i {
            font-size: 18px;
            font-style: normal;
            position: relative;
            top: -2px;
        }

        /*
        custome style
        */
        .input_qty_pr .items-count {
            border: 1px solid #ddd;
            outline: none;
            background: #fff;
            height: 24px;
            width: 24px;
            vertical-align: baseline;
            text-align: center;
            padding: 0;
        }
        .number-sidebar {
            border: 1px solid #ddd;
            height: 24px;
            margin-left: -1px;
            text-align: center;
            width: 23px;
            margin-right: -1px;
            padding: 0;
            line-height: 15px;
        }
    </style>
@endpush

@push('script')
    <script>
        // decrease qty product a unit
        function decreaseQtyUniy(that) {
            data = {
                "_token" :   "{{ csrf_token() }}",
                "cartId" : $(that).parent().find("input[name='cartID']").val(),
                'method': 'desc'
            };

            let num = $(that).parent().find("input[name='product_quantity']").val();
            if (num - 1 <= 0) {
                return;
            }

            showLoading();

            $.ajax({
                type    : 'post',
                url     : "{{ url('gio-hang/update') }}",
                data    : data,
                dataType: 'json',
                success : function (response) {
                    if (response.code == 200) {
                        location.reload();
                    }

                    if (response.code == 500) {
                        hideLoading();
                        alert(response.message);
                    }
                },
                error   : function (xhr,status,error) {
                    console.log('Co loi khi gui ajax');
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    hideLoading();
                }
            });
        }

        // increase qty product a unit
        function increaseQtyUnit(that) {
            data = {
                "_token" :   "{{ csrf_token() }}",
                "cartId" : $(that).parent().find("input[name='cartID']").val(),
                'method': 'asc'
            };

            showLoading();

            $.ajax({
                type    : 'post',
                url     : "{{ url('gio-hang/update') }}",
                data    : data,
                dataType: 'json',
                success : function (response) {
                    console.log(response.code);

                    if (response.code == 200) {
                        location.reload();
                    }

                    if (response.code == 500) {
                        hideLoading();
                        alert(response.message);
                    }
                },
                error   : function (xhr,status,error) {
                    console.log('Co loi khi gui ajax');
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    hideLoading();
                }
            });
        }
    </script>
@endpush

@section('content')

    <div class="cart-page">
        <div id="wrapper" class="wp-inner clearfix">

            @if (count($cart) > 0)
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        @include('layouts.frontend.structures._notification')
                        <table class="table">
                            <thead>
                            <tr>
                                <td>STT</td>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td width="20%">Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Thành tiền</td>
                                <td>Hành động</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $key => $item)
                                <tr>
                                    <td>{{ 1 + $key }}</td>
                                    <td>#{{ $item->tryGet('product')->id }}</td>
                                    <td>
                                        <a title="" class="thumb">
                                            @if ($item->tryGet('product')->avatar)
                                                <img src="{{ asset($item->tryGet('product')->avatar) }}">
                                            @else
                                                <img src="{{ asset('image/lap-top-default.png') }}">
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ frontendRouter('san-pham', ['id' => $item->tryGet('product')->id]) }}" style="color: black"
                                           title="" class="name-product">{{ $item->tryGet('product')->name }}</a>
                                    </td>

                                    <td>
                                        @if ($item->tryGet('product')->price_sell)
                                            {{ formatPriceCurrency($item->tryGet('product')->price_sell) }}
                                        @else
                                            {{ formatPriceCurrency($item->tryGet('product')->price_origin / 100 * (100 - (int)$item->tryGet('product')->sale)) }}
                                        @endif
                                        đ
                                    </td>
                                    <td>
                                        <div class="input_qty_pr">
                                            <input type="hidden" name="cartID" value="{{ $item->id }}">

                                            <button class="items-count btn-minus" type="button"
                                                    onclick="decreaseQtyUniy(this)"> – </button>

                                            <input type="text" class="number-sidebar" disabled
                                                   name="product_quantity" min="1" value="{{ $item->product_quantity }}">

                                            <button class="items-count btn-plus" type="button"
                                                    onclick="increaseQtyUnit(this)"> + </button>

                                        </div>
                                    </td>

                                    <td class="sub-total">
                                        @if ($item->tryGet('product')->price_sell)
                                            {{ formatPriceCurrency($item->tryGet('product')->price_sell * $item->product_quantity) }}
                                        @else
                                            {{ formatPriceCurrency($item->product_quantity * $item->tryGet('product')->price_origin / 100 * (100 - (int)$item->tryGet('product')->sale)) }}
                                        @endif
                                        đ
                                    </td>
                                    <td>
                                        <a href="{{ frontendRouter('cart.delete-item', ['id' => $item->id]) }}"
                                           class="del-product btn-danger"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm?');">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        {{--<form method="get" onsubmit="return confirm('Are you sure?');"--}}
                                              {{--action="{{ frontendRouter('cart.delete-item', ['id' => $item->id]) }}">--}}
                                            {{--@csrf--}}
                                            {{--<button style="border: none" type="submit" title="xoá sản phẩm"--}}
                                                    {{--class="del-product btn-danger"><i class="fa fa-trash-o"></i></button>--}}
                                        {{--</form>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span class="total">{{ formatPriceCurrency($totalPriceCart) }} đ</span>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a class="btn btn-danger" href="{{ frontendRouter('thanh-toan') }}" title="" id="">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
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
                        <p class="title"><strong>Giỏ hàng trống.</strong></p>
                    </div>
                </div>

                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <a href="{{ frontendRouter('home') }}" title="mua tiếp" id="buy-more">Mua tiếp</a><br>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
