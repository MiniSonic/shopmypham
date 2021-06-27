@extends('layouts.backend.main')

@section('content')
    <div class="content-page teacher-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Danh mục</h4>
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
                                <h5 class="card-title">Danh sách danh mục</h5>
                                <a href="{{backendRouter('category.create')}}">
                                    <button type="button" class="btn btn-cyan btn-sm">Thêm mới</button>
                                </a>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <table class="table table-striped table-bordered dataTable" role="grid">
                                    <thead>
                                    <tr>
                                        <th width="50px" scope="col">STT</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($entities as $key => $category)
                                            <tr>
                                                <td>{{ 1 + $key }}</td>
                                                <td>
                                                    @for ($i = 1; $i < $category->level; $i++)
                                                        |--- &nbsp;&nbsp;
                                                    @endfor
                                                    {{ $category->name }}
                                                </td>

                                                <td>
                                                    <div class="comment-footer">
                                                        <a href="{{ backendRouter('category.edit', ['id' => $category->getKey()]) }}">
                                                            <button type="button" class="btn btn-cyan btn-xs">Sửa</button>
                                                        </a>
                                                        <a href="#modal_confirm_delete"
                                                           class="btn-danger btn btn-xs modal_confirm_delete rounded"
                                                           data-toggle="modal"
                                                           data-form-action="{{ backendRouter('category.destroy', ['id' => $category->id]) }}"
                                                        >
                                                            Xóa
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
