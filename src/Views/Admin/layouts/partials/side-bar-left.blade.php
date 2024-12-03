<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Menu</li>
            <li>
                <a href="{{ routeAdmin() }}" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-dashboard">Dashboards</span>
                </a>
            </li>

            <li class="menu-title" key="t-administration">Administration</li>

            <li class="#">
                <a href="{{ routeAdmin('categories') }}" class="waves-effect #">
                    <i class="bx bx-receipt"></i>
                    <span key="t-categories">Categories</span>
                </a>
            </li>

            <li class="#">
                <a href="#" class="waves-effect #">
                    <i class="bx bx-user"></i>
                    <span key="t-users">Users</span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-share-alt"></i>
                    <span key="t-multi-level">Products</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                        <a href="{{ routeAdmin('products') }}" key="t-level-1-1">
                            Product List
                        </a>
                    </li>
                    <li>
                        <a href="{{ routeAdmin('product-tags') }}" key="t-level-1-2">
                            Product Tag
                        </a>
                    </li>
                    <li>
                        <a href="{{ routeAdmin('product-colors') }}" key="t-level-1-3">
                            Product Color
                        </a>
                    </li>
                </ul>
            </li>

            <li class="#">
                <a href="{{ routeAdmin('comments') }}" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-comments">Comments</span>
                </a>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-orders">Orders</span>
                </a>
            </li>

            <li class="menu-title" key="t-settings">Settings</li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="bx bx-receipt"></i>
                    <span key="t-banner">Banner</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
