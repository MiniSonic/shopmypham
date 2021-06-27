@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            background: #fff;
            padding: 20px 15px;
        }
    </style>
@endpush

@section('content')

    <div class="section" id="detail-blog-wp">
        <div class="section-head clearfix">
            <h3 class="section-title">Thông tin tài khoản</h3>
        </div>
        <div class="section-detail">
            <div class="detail">
                <form action="{{ frontendRouter('account.update.post') }}" method="POST">
                    @csrf
                    @include('layouts.frontend.structures._error_validate')
                    @include('layouts.frontend.structures._notification')

                    <div class="form-group row">
                        <label for="firstName" class="col-sm-2 col-form-label">Họ và tên</label>
                        <div class="col-sm-10 col-md-6 col-lg-6">
                            <input name="username" class="form-control" type="text" maxlength="30"
                                   placeholder="Họ và tên"
                                   value="{{ oldInput(old('username'), $user->username) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-md-2 col-lg-2 col-form-label">Email</label>
                        <div class="col-sm-10 col-md-6 col-lg-6">
                            <input name="email" class="form-control"
                                   type="email" value="{{ oldInput(old('email'), $user->email) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Số điện thoại:</label>
                        <div class="col-sm-10 col-md-6 col-lg-6">
                            <div class="phoneInput_Q_2V">
                                <input name="phone" class="form-control" type="text"
                                       value="{{ oldInput(old('phone'), $user->phone) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Địa chỉ:</label>
                        <div class="col-sm-10 col-md-6 col-lg-6">
                            <div class="phoneInput_Q_2V">
                                <input name="address" class="form-control" type="text"
                                       value="{{ oldInput(old('address'), $user->address) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Mật khẩu:</label>
                        <div class="col-sm-10 col-md-6 col-lg-6">
                            <div class="phoneInput_Q_2V">
                                <input name="password" class="form-control" type="text"
                                       value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-danger">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
