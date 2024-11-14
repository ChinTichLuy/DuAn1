<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="LuxChill DashBoard" name="description" />
    <meta content="LuxChill" name="author" />

    @include('layouts.partials.css')
    @yield('style')

    <title>@yield('title')</title>
</head>

<body data-sidebar="dark">

    @include('layouts.')

    <div id="layout-wrapper">

        <header id="page-topbar">
            @include('layouts.partials.header-topbar')
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">
            @include('layouts.partials.side-bar-left')
        </div>
        <!-- Left Sidebar End -->

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                @include('layouts.partials.footer')
            </footer>
        </div>

    </div>

    <div class="rightbar-overlay"></div>

    @include('layouts.partials.config')
    @include('layouts.partials.script')
    @yield('script')
    {{ unsetSession() }}
</body>

</html>