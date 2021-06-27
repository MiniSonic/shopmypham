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
                            @include('layouts.backend.structures._notification')

                            <div class="card-body__head d-flex">
                                <h5 class="card-title">Danh sách đơn hàng</h5>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <table class="table table-striped table-bordered dataTable" role="grid">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên khách hàng</th>
                                            <th scope="col">SĐT</th>
                                            <th scope="col">Địa chỉ</th>
                                            <th scope="col">Tổng tiền (VNĐ)</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($entities as $key => $entity )
                                        <tr>
                                            <td>{{ getSTTBackend($entities, $key) }}</td>
                                            <td>{{ $entity->name }}</td>
                                            <td>{{ $entity->phone }}</td>
                                            <td>{{ $entity->address }}</td>
                                            <td>{{ formatPriceCurrency($entity->total_money) }}</td>
                                            <td>{!! getOrderStatus($entity->status)  !!}</td>
                                            <td>
                                                <div class="comment-footer">
                                                    @if ($entity->status == getConfig('order-status-new'))
                                                        <a href="{{ backendRouter('order.edit', ['id' => $entity->getKey()]) }}">
                                                            <button type="button" class="btn btn-cyan btn-xs">Sửa</button>
                                                        </a>
                                                    @endif
                                                    <a href="{{ backendRouter('order.show', ['id' => $entity->getKey()]) }}">
                                                        <button type="button" class="btn btn-info btn-xs">Chi tiết</button>
                                                    </a>
                                                </div>
                                            </td>
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
