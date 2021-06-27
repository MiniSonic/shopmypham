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
        <h3 class="section-title">Đăng nhập</h3>
    </div>
    <div class="section-detail">
        <div class="detail">
            <div class="row">
                <div class="col-sm-6">
                    <form class="form-horizontal" method="POST" action="{{ frontendRouter('login.post') }}" enctype="multipart/form-data">
                        @csrf
                        @include('layouts.frontend.structures._error_validate')
                        @include('layouts.frontend.structures._notification')

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Nhập email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu *</label>
                            <input type="password" name="password" class="form-control"  placeholder="Nhập mật khẩu" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
