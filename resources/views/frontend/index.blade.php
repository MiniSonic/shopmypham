@extends('layouts.frontend.main')

@push('style')
    <link href="{{ asset('frontend/css/page/home.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="section" id="slider-wp">
        <div class="section-detail">
            <div class="item">
                <img src="{{ asset('frontend/theme/image/slider-01.png') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('frontend/theme/image/slider-02.png') }}" alt="">
            </div>
            <div class="item">
                <img src="{{ asset('frontend/theme/image/slider-03.png') }}" alt="">
            </div>
			<div class="item">
                <img src="{{ asset('frontend/theme/image/slider-04.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="section" id="support-wp">
        <div class="section-detail">
            <ul class="list-item clearfix">
                <li>
                    <div class="thumb">
                        <img src="{{ asset('frontend/theme/image/icon-1.png') }}">
                    </div>
                    <h3 class="title">Miễn phí vận chuyển</h3>
                    <p class="desc">Tới tận tay khách hàng</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{ asset('frontend/theme/image/icon-2.png') }}">
                    </div>
                    <h3 class="title">Tư vấn 24/7</h3>
                    <p class="desc">1900.9999</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{ asset('frontend/theme/image/icon-3.png') }}">
                    </div>
                    <h3 class="title">Tiết kiệm hơn</h3>
                    <p class="desc">Với nhiều ưu đãi cực lớn</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{ asset('frontend/theme/image/icon-4.png') }}">
                    </div>
                    <h3 class="title">Giao diện thân thiện</h3>
                    <p class="desc">Dễ dàng đặt hàng</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{ asset('frontend/theme/image/icon-5.png') }}">
                    </div>
                    <h3 class="title">Đặt hàng online</h3>
                    <p class="desc">Thao tác đơn giản</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="section" id="feature-product-wp" style="margin-bottom: 50px;">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm nổi bật</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item clearfix">
                @foreach($productHot as $key => $product)
                    <li>
                        <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title="" class="thumb">
                            @if ($product->avatar)
                                <img src="{{ asset($product->avatar) }}">
                            @else
                                <img src="{{ asset('image/lap-top-default.png') }}">
                            @endif
                        </a>
                        <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title="" class="product-name two_dots">{{ $product->name }}</a>
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

    @foreach($data as $key => $items)
        <div class="section feature-product-wp" style="margin-bottom: 50px;">
            <div class="section-head clearfix">
                <h3 class="section-title float-left">{{ $items->first() ? $items->first()->tryGet('category')->name : '' }}</h3>

                @if (count($items) > 0)
                <a href="{{ frontendRouter('danh-muc', ['id' => $items->first() ? $items->first()->tryGet('category')->id : '']) }}"
                   class="section-title float-right"
                   style="font-size: 16px;text-transform: initial; color: black">Xem tất cả</a>
                @endif
            </div>
            <br>
            <div class="section-detail">
                <ul class="list-item row">
                    @foreach($items as $item)
                        <li class="col-6 col-sm-3">
                            <a href="{{ frontendRouter('san-pham', ['id' => $item->id]) }}" title="" class="thumb">
                                @if ($item->avatar)
                                    <img src="{{ asset($item->avatar) }}">
                                @else
                                    <img src="{{ asset('image/lap-top-default.png') }}">
                                @endif
                            </a>
                            <a href="{{ frontendRouter('san-pham', ['id' => $item->id]) }}"
                               title="" class="product-name two_dots"> {{ $item->name }}
                            </a>
                            <div class="price text-left">
                                <span class="new">{{ formatPriceCurrency($item->price_origin) }}đ</span>
                            </div>
                            @if ($item->sale)
                                <div class="price text-left text-muted">
                                    <span style="text-decoration: line-through">{{ formatPriceCurrency($item->price_origin * 100 / (100 - $item->sale)) }}đ</span>
                                </div>
                                <div class="price text-left text-danger">
                                    <small>Khuyến mại: {{ formatPriceCurrency($item->sale) }}%</small>
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
    @endforeach
@endsection
