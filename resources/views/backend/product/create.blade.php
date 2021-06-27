@extends('layouts.backend.main')

@push('script')
    <script src="{{ asset('backend/js/pages/product.js') }}"></script>
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
                            <h5 class="card-title">Thêm mới</h5>
                            <a href="{{backendRouter('product.index')}}">
                                <button type="button" class="btn btn-cyan btn-sm">Quay lại</button>
                            </a>
                        </div>

                        <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="card">
                                <form class="form-horizontal" action="{{backendRouter('product.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    @include('layouts.backend.structures._error_validate')
                                    @include('layouts.frontend.structures._notification')

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tên *</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="name" required value="{{old('name')}}" placeholder="Nhập tên">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Ảnh đại diện</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" name="avatar" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mô tả ngắn</label>
                                                    <div class="col-sm-8">
                                                        <textarea  type="text" class="form-control" maxlength="255" rows="5"
                                                                   name="sort_describe" placeholder="Nhập mô tả ngắn">{{ old('sort_describe') }} </textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 text-right control-label col-form-label">Danh mục *</label>
                                                    <div class="col-md-8">
                                                        <div class="my-select2">
                                                            <select class="select2-category-course select2-category-course-wrapper select2-wrapper" name="category_id">
                                                                <option selected readonly value="">--- Vui lòng chọn ---</option>
                                                                @foreach($category as $item)
                                                                    <option value = "{{ arrayGet($item, 'id') }}" {{ old('category_id') == arrayGet($item, 'id') ? "selected" : '' }}>
                                                                        {{ arrayGet($item, 'name') }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Giá gốc (VNĐ) *</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" name="price_origin" value="{{old('price_origin')}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Khuyến mại (%)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" name="sale" value="{{old('sale')}}">
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
