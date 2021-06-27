@extends('layouts.backend.main')

@section('content')
    <div class="content-page teacher-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Đơn hàng</h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body__head d-flex">
                                <h5 class="card-title">Thông tin đơn hàng</h5>
                                <a href="{{ backendRouter('order.index') }}">
                                    <button type="button" class="btn btn-cyan btn-sm">Trở lại</button>
                                </a>
                            </div>
                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table class="table table-striped table-bordered dataTable" role="grid">
                                    <tbody>
                                        <tr>
                                            <td class="bold">#</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td class="bold">Tên khách hàng</td>
                                            <td>{{ $entity->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold">SĐT</td>
                                            <td>{{ $entity->phone }}</td>
                                        </tr>

                                        <tr>
                                            <td class="bold">Địa chỉ</td>
                                            <td>{{ $entity->address }}</td>
                                        </tr>

                                        <tr>
                                            <td class="bold">Tổng số tiền (VNĐ)</td>
                                            <td>{{ formatPriceCurrency($entity->total_money) }}</td>
                                        </tr>

                                        <tr>
                                            <td class="bold">Trạng thái</td>
                                            <td>{!! getOrderStatus($entity->status)  !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body__head d-flex">
                                <h5 class="card-title">Danh sách sản phẩm</h5>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <table class="table table-striped table-bordered dataTable" role="grid">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Giá (VNĐ)</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền (VNĐ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($entity->orderDetails as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><a href="{{frontendRouter('san-pham', ['id' => $value->product_id])}}">{{ $value->product_name }}</a></td>
                                                <td>
                                                    @if ($value->tryGet('product')->avatar)
                                                        <img src="{{ asset($value->tryGet('product')->avatar) }}" alt="" width="50px">
                                                    @else
                                                        <img src="{{ asset('backend/image/no-image.jpg') }}" alt="" width="50px">
                                                    @endif
                                                </td>
                                                <td>
                                                    Giá gốc: {{ formatPriceCurrency($value->product_price_origin) }} <br>
                                                    Sale: {{ $value->product_sale }} % <br>
                                                    Giá bán: {{ formatPriceCurrency($value->product_price_sell) }} <br>
                                                </td>
                                                <td>{{ $value->product_quantity }}</td>
                                                <td>{{ formatPriceCurrency($value->product_quantity * $value->product_price_sell) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop