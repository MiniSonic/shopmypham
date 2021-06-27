@extends('layouts.backend.main')

@push('script')
    <script src="{{ asset('backend/js/pages/order.js') }}"></script>
@endpush

@section('content')
    <div class="content-page teacher-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title"></h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body__head d-flex">
                                <h5 class="card-title">Cập nhật</h5>
                                <a href="{{backendRouter('order.index')}}">
                                    <button type="button" class="btn btn-cyan btn-sm">Quay lại</button>
                                </a>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="card">
                                    <form class="form-horizontal" action="{{backendRouter('order.update', ['id' => $entity->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        @include('layouts.backend.structures._error_validate')
                                        @include('layouts.frontend.structures._notification')

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 text-right control-label col-form-label">Trạng thái *</label>
                                                        <div class="col-md-8">
                                                            <div class="my-select2">
                                                                <select required class="select2-category-course select2-category-course-wrapper select2-wrapper" name="status">
                                                                    <option selected readonly value="">--- Vui lòng chọn ---</option>
                                                                    @foreach(getConfig('order-status') as $key => $value)
                                                                        <option value = "{{ $key }}" {{ $entity->status == $key ? "selected" : '' }}>
                                                                            {{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top">
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-success">Gửi đi</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
