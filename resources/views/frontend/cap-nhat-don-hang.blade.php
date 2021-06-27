@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            width: 100%;
        }

        .sidebar {
            display: none;
        }

        #customer-info-wp .form-row .form-col {
            width: 100%;
            padding-right: 30px;
        }
    </style>
@endpush

@section('content')

    <div class="checkout-page">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <form method="POST" action="{{ frontendRouter('account.order.update.post', ['id' => $order->id]) }}" name="form-checkout" enctype="multipart/form-data">
                        @csrf
                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')

                        <div class="form-row ">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="name" placeholder="Nhập họ tên" value="{{ oldInput(old('name'), $order->name) }}" required>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-col fl-left">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{ oldInput(old('phone'), $order->phone) }}"
                                       required>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col fl-left">
                                <label for="phone">Địa chỉ</label>
                                <input type="text" name="address" placeholder="Nhập địa chỉ" value="{{ oldInput(old('address'), $order->address) }}"
                                       required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col fl-left">
                                <div class="my-select2">
                                    <label for="phone">Trạng thái</label>
                                    <select class="select2-category-course select2-category-course-wrapper select2-wrapper" name="status">
                                        <option selected readonly value="">--- Vui lòng chọn ---</option>
                                        @foreach(getConfig('order-status') as $key => $item)
                                            @if ($key != getConfig('order-status-success') && $key != getConfig('order-status-cancel-by-admin'))
                                                <option value = "{{ $key }}" {{ oldInput(old('status'), $order->status) == $key  ? "selected" : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="place-order-wp clearfix">
                            <button type="submit" class="btn btn-danger">Cập nhật</button>
                            <a href="{{ frontendRouter('account.order.history') }}" class="btn btn-danger">Trở lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
