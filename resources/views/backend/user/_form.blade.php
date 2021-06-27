@push('script')
    <script src="/backend/js/pages/user.js"></script>
@endpush

@push('styles')
    <link href="/backend/css/pages/user.css" rel="stylesheet">
@endpush


<div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Username <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" value="{{ $entity->username }}" placeholder="Nhập họ và tên">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 text-right control-label col-form-label">Email <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="email" value="{{ $entity->email }}" placeholder="Nhập email">
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group row">
                <label for="phone_number" class="col-sm-3 text-right control-label col-form-label">Số điện thoại</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control phone-inputmask" name="phone" id="phone-mask" value="{{ $entity->phone }}" placeholder="Nhập số điện thoại">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-sm-3 text-right control-label col-form-label">Địa chỉ</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="address" id="phone-mask" value="{{ $entity->address }}" placeholder="Nhập địa chỉ">
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
