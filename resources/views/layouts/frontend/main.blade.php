<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <title>{{ getSiteName() }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="TzivisrDQXT5IWYg46zXshgyZAFn8LYCqFgz72qR">
    <link rel="icon" type="image/png" href="{{ asset('image/logo2.png') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap4.5.2/bootstrap-theme.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap4.5.2/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/theme/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/carousel/owl.carousel.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/carousel/owl.theme.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/font-awesome/css/font-awesome.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/theme/css/style.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/theme/css/responsive.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/common.css') }}"/>

    @stack('style')
</head>
<body>
<div id="site">
    <div id="container">
        <div id="header-wp">
            <div id="head-top" class="clearfix">
                <div class="wp-inner clearfix">
                    <div id="main-menu-wp" class="fl-right">
                        <ul id="main-menu" class="clearfix">
                            <li>
                                <a href="{{ frontendRouter('home') }}" title="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="{{ frontendRouter('gioi-thieu') }}" title="">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="{{ frontendRouter('lien-he') }}" title="">Liên hệ</a>
                            </li>

                            @if (frontendCurrentUser())
                                <li>
                                    <a href="{{ frontendRouter('account') }}" title="">Tài khoản</a>
                                </li>

                                <li>
                                    <a href="{{ frontendRouter('account.order.history') }}" title="">Đơn hàng</a>
                                </li>

                                <li>
                                    <a href="{{ frontendRouter('logout') }}" title="">Đăng xuất</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ frontendRouter('login.get') }}" title="">Đăng nhập</a>
                                </li>

                                <li>
                                    <a href="{{ frontendRouter('register.get') }}" title="">Đăng kí</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div id="head-body" class="clearfix">
                <div class="wp-inner clearfix">
                    <a href="{{ frontendRouter('home') }}" title="" id="logo" class="fl-left">
                        <img src="{{ asset('image/logo2.png') }}" style="width: 70px; object-fit: cover"/>
                    </a>
                    <div id="search-wp" class="fl-left">
                        <form method="GET" action="{{ frontendRouter('tim-kiem') }}" style="position: relative; z-index: 11;">
                            @csrf
                            <input type="text" name="search" value="{{ request('search') }}" id="s" placeholder="Nhập sản phẩm tìm kiếm tại đây!">
                            <button type="submit" id="sm-s">Tìm kiếm</button>
                        </form>
                    </div>
                    <div id="action-wp" class="fl-right">
                        <div id="advisory-wp" class="fl-left">
                            <span class="title">Tư vấn</span>
                            <span class="phone">0123.456.789</span>
                        </div>
                        <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                        <a href="{{ frontendRouter('gio-hang') }}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span id="num" class="num-pd">{{ arrayGet($viewComposer, 'numberItemInCart') }}</span>
                        </a>
                        <div id="cart-wp" class="fl-right">
                            <div id="btn-cart">
                                <a href="{{ frontendRouter('gio-hang') }}">
                                <i class="fa fa-shopping-cart" aria-hidden="true" style="color: white"></i></a>
                                <span id="num" class="num-pd">{{ arrayGet($viewComposer, 'numberItemInCart') }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END-Header -->
        <div id="main-content-wp" class="home-page">
            <div class="wp-inner clearfix">
                <div class="main-content fl-right">
                    @yield('content')
                </div>

                <div class="sidebar fl-left">
                    <div class="section" id="category-product-wp">
                        <div class="section-head">
                            <h3 class="section-title">Danh mục sản phẩm</h3>
                        </div>
                        <div class="secion-detail">
                            <ul class="list-item">
                                @foreach(arrayGet($viewComposer, 'categories') as $category)
                                    @if ($category->level != 1)
                                        @continue
                                    @endif
                                    <li>
                                        <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}" title="">{{ $category->name }}</a>
                                        @if ($category->children()->count() > 0)
                                            <ul class="sub-menu">
                                                @foreach ($category->children as $child)
                                                    <li>
                                                        <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}" title="">{{ $child->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="section" id="selling-wp">
                        <div class="section-head">
                            <h3 class="section-title">Sản phẩm bán chạy</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item">
                                @foreach(arrayGet($viewComposer, 'mostSellProduct') as $key => $order)
                                    @php $product = $order->tryGet('product'); @endphp
                                    <li class="clearfix">
                                        <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title="" class="thumb fl-left">
                                            @if ($product->avatar)
                                                <img src="{{ asset($product->avatar) }}" width="72px">
                                            @else
                                                <img src="{{ asset('image/lap-top-default.png') }}" width="72px">
                                            @endif
                                        </a>
                                        <div class="info fl-right">
                                            <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title=""
                                               class="product-name">Samsung Galaxy Note 10</a>
                                            <div class="price">
                                                <span class="new">
                                                     @if ($product->price_sell)
                                                        {{ formatPriceCurrency($product->price_sell) }}
                                                    @else
                                                        {{ formatPriceCurrency($product->price_origin / 100 * (100 - $product->sale)) }}
                                                    @endif
                                                    đ
                                                </span>
                                                @if ($product->sale)
                                                    <span class="new"> - {{$product->sale}}%</span>
                                                @endif
                                            </div>
                                            <small>( {{ $order->count }} sản phẩm )</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- END-Content -->
        <div id="footer-wp">
            <div id="foot-body">
                <div class="wp-inner clearfix">
                    <div class="block" id="info-company">
                        <h3 class="title">SHOP MỸ PHẨM MY FAMILY</h3>
                        <p class="desc">SHOP MỸ PHẨM MY FAMILY luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính
                            sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                        <div id="payment">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ asset('frontend/theme/image/img-foot.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="block menu-ft" id="info-shop">
                        <h3 class="title">Thông tin cửa hàng</h3>
                        <ul class="list-item">
                            <li>
                                <p>Việt Nam</p>
                            </li>
                            <li>
                                <p>0123.456.789</p>
                            </li>
                            <li>
                                <p>shopmyphamchinhhang@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="foot-bot">
                <div class="wp-inner">
                    <p id="copyright">© Copyright</p>
                </div>
            </div>
        </div>
        <!-- END-Footer -->
    </div>
    <!-- END-Container -->
    <div id="menu-respon">
        <a title="" class="logo bg-secondary"><img src="{{ asset('/image/logo2.png') }}"/></a>
        <div id="menu-respon-wp">
            <ul class="" id="main-menu-respon">
                @foreach(arrayGet($viewComposer, 'categories') as $category)
                    @if ($category->level != 1)
                        @continue
                    @endif
                    <li>
                        <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}" title="">{{ $category->name }}</a>
                        @if ($category->children()->count() > 0)
                            <ul class="sub-menu">
                                @foreach ($category->children as $child)
                                    <li>
                                        <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}" title="">{{ $child->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- END-Menu-respon -->

    <div id="btn-top"><img class="img-fluid" src="{{ asset('frontend/theme/image/icon-to-top.png') }}" alt=""/></div>
    <div id="fb-root"></div>
    <!-- The-END -->
</div>
<script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery.ez-plus.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/easyzoom/easyzoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/popper/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/bootstrap4.5.2/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/carousel/owl.carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/theme/main.js') }} "></script>
<script type="text/javascript" src="{{ asset('backend/libs/loadingoverlay/loadingoverlay.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/common.js') }}"></script>

@stack('script')

</body>
</html>
