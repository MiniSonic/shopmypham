<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('dashboard') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Trang chủ</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('user.list') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Người dùng</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('category.list') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Danh mục</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('product.index') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Sản phẩm</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('order.index') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Đơn hàng</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('logout') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
