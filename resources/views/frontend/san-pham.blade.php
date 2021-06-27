@extends('layouts.frontend.main')

@push('script')
    <script>
      function requiredLogin() {
        alert("Bạn phải login để có thể thêm sản phẩm vào giỏ hàng");
      }
    </script>
@endpush

@section('content')

    @php $product->avatar == empty($product->avatar) ? "image/lap-top-default.png" : $product->avatar @endphp

    <div class="section" id="detail-product-wp">
        <div class="section-detail clearfix">
            <div class="thumb-wp fl-left">
                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                    <a id="show" href="#">
                        <img id="zoom" src="#" alt="" width="350" height="350"/>
                    </a>
                </div>
                <ul id="list-thumb-img" class="thumbnails my-4 d-inline-block">
                    <li>
                        <a href="{{ asset($product->avatar) }}"
                           data-standard="{{ asset($product->avatar) }}">
                            <img width="50px" id="zoom" src="{{ asset($product->avatar) }}"/>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="thumb-respon-wp fl-left">
                <img src="{{ asset($product->avatar) }}">
            </div>

            @include('layouts.frontend.structures._notification')

            <div class="info fl-right">
                <h3 class="product-name">{{ $product->name }}</h3>
                <div class="desc">
                    <p>
                        {!! nl2br(e($product->sort_describe)) !!}
                    </p>
                </div>
                <form action="{{ frontendRouter('them-gio-hang', ['id' => $product->id]) }}" method="get" enctype="multipart/form-data">

                    @csrf

                    <div class="price text-left">
                        <span class="new">{{ formatPriceCurrency($product->price_origin) }}đ</span>
                    </div>

                    @if ($product->sale)
                        <div class="price text-left text-muted">
                            <span style="text-decoration: line-through">{{ formatPriceCurrency($product->price_origin * 100 / (100 - $product->sale)) }}đ</span>
                        </div>
                        <div class="text-left text-danger">
                            <small>Khuyến mại: {{ formatPriceCurrency($product->sale) }}%</small>
                        </div>
                    @else
                        <div class="price text-left text-muted">
                            <span>&nbsp</span>
                        </div>
                        <div class="price text-left text-danger">
                            <small>&nbsp</small>
                        </div>
                    @endif
                    <input type="hidden" name="_token" value="TzivisrDQXT5IWYg46zXshgyZAFn8LYCqFgz72qR">

                    <div id="num-order-wp">
                        <span class="title">Số lượng: </span>
                        <a title="" id="minus"><i class="fa fa-minus"></i></a>
                        <input type="text" name="product_quantity" readonly="readonly" value="1" id="num-order">
                        <a title="" id="plus"><i class="fa fa-plus"></i></a>
                    </div>

                    @if (frontendCurrentUser())
                        <button type="submit" name="btn-addx" title="Thêm giỏ hàng" class="mt-3 btn btn-danger">
                            Thêm giỏ hàng
                        </button>
                    @else
                        <button type="button" name="btn-add" title="Thêm giỏ hàng" class="mt-3 btn btn-danger" onclick="requiredLogin()">
                            Thêm giỏ hàng
                        </button>
                    @endif
                </form>

            </div>
        </div>
    </div>

    <div class="section" id="same-category-wp">
        <div class="section-head">
            <h3 class="section-title">Cùng chuyên mục</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                @foreach($relationProduct as $product)
                    <li>
                        <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title="" class="thumb">
                            <img src="{{ asset($product->avatar) }}">
                        </a>
                        <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title=""
                           class="product-name two_dots">{{ $product->name }}</a>
                        <div class="price text-left">
                            <span class="new">{{ formatPriceCurrency($product->price_origin) }}đ</span>
                        </div>

                        @if ($product->sale)
                            <div class="price text-left text-muted">
                                <span style="text-decoration: line-through">{{ formatPriceCurrency($product->price_origin * 100 / (100 - $product->sale)) }}đ</span>
                            </div>
                            <div class="price text-left text-danger">
                                <small>Khuyến mại: {{ formatPriceCurrency($product->sale) }}%</small>
                            </div>
                        @else
                            <div class="price text-left text-muted">
                                <span>&nbsp</span>
                            </div>
                            <div class="price text-left text-danger">
                                <small>&nbsp</small>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>

        </div>
    </div>

@endsection
