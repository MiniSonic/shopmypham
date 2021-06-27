@extends('layouts.backend.main')

@section('content')
<div class="content-page">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Người dùng</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.backend.structures._notification')
                        @include('layouts.backend.structures._error_validate')

                        <div class="card-body__head d-flex">
                            <h5 class="card-title">Cập nhật mật khẩu người dùng</h5>
                            <a href="{{ backendRouter('user.edit', ['id' => $entity->id]) }}">
                                <button type="button" class="btn btn-cyan btn-sm">Quay lại</button>
                            </a>
                        </div>

                        <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="card">
                                <form class="form-horizontal" action="{{backendRouter('user.change-password.post', ['id' => $entity->getKey()])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mật khẩu mới <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="password" value="" placeholder="Nhập mật khẩu mới">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3 text-right control-label col-form-label">Xác nhận mật khẩu mới <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="password_confirmation" value="" placeholder="Nhập lại mật khẩu mới">
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