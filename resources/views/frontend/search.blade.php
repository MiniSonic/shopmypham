@extends('layouts.frontend.main')

@push('style')
    <style>
        .cdt-dropdown-menu li {
            padding: 5px 10px;
            cursor: pointer;
            white-space: nowrap;
        }

        .cdt-dropdown-menu li.active {
            font-weight: 700;
            background-color: #a1a1a11c;
        }
    </style>
@endpush

@push('script')
    <script>
      $(document).ready(function () {
        $(".cdt-dropdown").click(function () {
          $(this).toggleClass('active');
        });
        var ckeck = $(".cdt-dropdown-menu li").hasClass('sortdefault');
        if (ckeck) {
          $(".cdt-dropdown-menu li.sortdefault ").addClass('active');
        }
        var active = $(".cdt-dropdown-menu li").hasClass('active');
        if (active) {
          var content = $(".cdt-dropdown-menu li.active").html();
          $('.cdt-dropdown-button').html(content);
        }
        $(".cdt-dropdown-menu li").click(function () {
          var html_click = $(this).html();
          $('.cdt-dropdown-button').html(html_click);//gán vào .cdt-dropdown-button
          $(".cdt-dropdown-menu li").removeClass('active');
          $(this).addClass('active');
          var sort = $(".cdt-dropdown-menu li.active").attr('data-value');
          var price = $("#filter .price").attr("price-value");
          var brand = $("#filter .brand").attr("brand-value");
          var data = {sort: sort, price: price, brand: brand};
          $.ajax({
            url: "",
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (data) {
              $("div#list-product").html(data.list_product);
              $("#paging-wp").html(data.pagingnate);
            },
            error: function (xhr, ajaxOptions, thrownError) {
              // alert(xhr.status);
              // alert(thrownError);
            }
          });
        });
      });
    </script>
@endpush

@section('content')
    <div class="section" id="list-product-wp">
        <div class="section-head clearfix">
            <h3 class="section-title fl-left"></h3>
            <span class="ml-1 text-secondary count" style="font-size: 18px">{{ $countProducts }} sản phẩm</span>
            <div class="filter-wp fl-right">
                <h5 class="title-filter">Sắp xếp:</h5>
                <label class="cdt-dropdown">
                    <div class="cdt-dropdown-button">Bán chạy nhất</div>
                    <ul class="cdt-dropdown-menu">
                        <li class="frowitem sort sortdefault" data-value="ban-chay-nhat">Bán chạy nhất
                        </li>
                        <li class="frowitem sort" data-value="gia-thap-den-cao">Giá thấp</li>
                        <li class="frowitem sort" data-value="gia-cao-den-thap">Giá cao</li>
                    </ul>
                </label>
            </div>
        </div>
        <div class="section-detail" id="list-product">
            <ul class="list-item clearfix">
                @foreach($products as $key => $product)
                    <li>
                        <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title="" class="thumb">
                            @if ($product->avatar)
                                <img src="{{ asset($product->avatar) }}">
                            @else
                                <img src="{{ asset('image/lap-top-default.png') }}">
                            @endif
                        </a>
                        <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}" title=""
                           class="product-name text-left">{{ $product->name }}</a>
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

        <br>

        <!-- Pagination -->
        {{ $products->appends(\Illuminate\Support\Facades\Input::all())->links('layouts.frontend.structures._pagination')}}
    </div>
@endsection
