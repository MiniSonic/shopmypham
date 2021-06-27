@extends('layouts.backend.main')

@section('content')
<div class="content-page teacher-page">
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

                        <div class="card-body__head card-body__filter">
                            <h5 class="card-title bold">Bộ lọc</h5>
                        </div>

                        <!-- From search -->
                        <form method="GET" action="{{ backendRouter('user.list') }}" class="mb-5" id="form-search">
                            <div class="form-row">
                                <div class="col-md-1">
                                    <input type="text" name="id" class="form-control" placeholder="ID" value="{{ request('id') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="username" class="form-control" placeholder="Tên" value="{{ request('username') }}">
                                </div>
                            </div>

                            <div class="card-body__head card-body__filter text-center">
                                <button type="submit" class="btn btn-cyan btn-sm">Tìm kiếm</button>
                            </div>
                        </form>

                        <div class="card-body__head d-flex">
                            <h5 class="card-title">Danh sách người dùng</h5>
                        </div>

                        <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table class="table table-striped table-bordered dataTable" role="grid">
                                <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">ID</th>
                                    <th scope="col" width="200px">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($entities as $key => $entity)
                                    <tr>
                                        <td>{{ getSTTBackend($entities, $key) }}</td>
                                        <td>{{ $entity->id }}</td>
                                        <td>{{ $entity->username }}</td>
                                        <td>{{ $entity->email }}</td>
                                        <td>{{ $entity->phone }}</td>
                                        <td>{{ $entity->address }}</td>
                                        <td>
                                            <div class="comment-footer">
                                                <a href="{{ backendRouter('user.edit', ['id' => $entity->getKey()]) }}">
                                                    <button type="button" class="btn btn-cyan btn-xs">Sửa</button>
                                                </a>
                                                <a href="#modal_confirm_delete"
                                                   class="btn-danger btn btn-xs modal_confirm_delete rounded"
                                                   data-toggle="modal"
                                                   data-form-action="{{ backendRouter('user.destroy', ['id' => $entity->id]) }}"
                                                >
                                                    Xóa
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{ $entities->appends(\Illuminate\Support\Facades\Input::all())->links('layouts.backend.structures._pagination')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
