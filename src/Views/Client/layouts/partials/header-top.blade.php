<div class="container">
    <div class="header-left d-none d-sm-block">
        <p class="top-message text-uppercase">FREE Returns. Standard Shipping Orders $99+</p>
    </div>
    <!-- End .header-left -->
    <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
        <div class="header-dropdown dropdown-expanded d-none d-lg-block">
            <a href="demo4.html#">Links</a>
            <div class="header-menu">
                <ul>
                    @if (!empty($_SESSION['user']))
                        <li>
                            <a href="#">Account</a>
                        </li>
                        <div>
                            <li>
                                <a href="#">Logout</a>
                            </li>
                            <form id="logout-form" action="#" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @else
                        <li>
                            <a href="#">Login</a>
                        </li>
                        <li>
                            <a href="#">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- End .header-menu -->
        </div>
        <!-- End .header-dropown -->
        <span class="separator"></span>
        <div class="header-dropdown">
            {{-- <a href="demo4.html#"><i class="flag-us flag"></i>ENG</a> --}}
            <a style="cursor: pointer">
                <i class="flag-us flag"></i>
                <span>ENG</span>
            </a>
            <div class="header-menu">
                <ul>
                    <li>
                        <a href="#">
                            <i class="flag-us flag"></i>
                            <span>ENG</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="flag-vn flag"></i>
                            <span>VI</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End .header-menu -->
        </div>
        <!-- End .header-dropown -->
        <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
            <a href="#">USD</a>
            <div class="header-menu">
                <ul>
                    {{-- <li><a href="demo4.html#">USD</a></li> --}}
                    <li>
                        <a href="#">VI</a>
                    </li>
                </ul>
            </div>
            <!-- End .header-menu -->
        </div>
        <!-- End .header-dropown -->
        <span class="separator"></span>
        <div class="social-icons">
            <a href="demo4.html#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
            <a href="demo4.html#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
            <a href="demo4.html#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
        </div>
        <!-- End .social-icons -->
    </div>
    <!-- End .header-right -->
</div>
