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
            <h3 class="section-title">
                <strong class="cat-name">{{ $category->name }}</strong>
                <span class="ml-1 text-secondary count" style="font-size: 18px">( {{ $countProducts }}  sản phẩm)</span>
            </h3>
            <br>
            <div class="filter">
                <form class="form-inline" method="get" action="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}">
                    @csrf
                    <div class="form-check mb-2 mr-sm-2">
                        <select class="form-control" name="price">
                            <option value="">--- Lọc Giá ---</option>
                            <option value="asc" {{ request('price') == "asc" ? "selected" : "" }}>Tăng dần</option>
                            <option value="desc" {{ request('price') == "desc" ? "selected" : "" }}>Giảm dần</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-danger mb-2">Tìm kiếm</button>
                </form>
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
                           class="product-name text-left three_dots">{{ $product->name }}</a>
                        <div class="price text-left">
                            <span class="new">{{ formatPriceCurrency($product->price_origin) }}đ</span>
                        </div>

                        @if ($product->sale)
                            <div class="price text-left text-muted">
                                <span style="text-decoration: line-through">{{ formatPriceCurrency($product->price_origin / 100 * (100 - $product->sale)) }}đ</span>
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
