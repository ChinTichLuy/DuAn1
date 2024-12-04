<!DOCTYPE html>
<html lang="en">
{{-- lang="{{ str_replace('_', '-', app()->getLocale()) }}" --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Nhom 1 Ecommerce" />
    <meta name="description" content="Website Ecommerce by Nhom">
    <meta name="author" content="Nhom">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    {{-- css all --}}
    @include('layouts.partials.css')
    {{-- css local --}}
    @yield('style')
    <title>@yield('title')</title>
</head>

<body>
    <div class="page-wrapper">
        <div class="top-notice bg-primary text-white">
            @include('layouts.components.top-notice')
        </div>
        <header class="header">
            <div class="header-top">
                @include('layouts.partials.header-top')
            </div>
            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                @include('layouts.partials.header-middle')
            </div>
            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                @include('layouts.partials.header-bottom')
            </div>
        </header>
        <main class="main">
            @yield('content')
        </main>
        <footer class="footer bg-dark">
            @include('layouts.partials.footer')
        </footer>
    </div>
    {{-- loading effect --}}
    @include('layouts.components.loading-overlay')
    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->
    @include('layouts.components.mobile-menu-container')
    <!-- End .mobile-menu-container -->
    @include('layouts.components.mobile-sticky-navbar')
    {{-- alert --}}
    @php
        $showNewLetter = false;
    @endphp
    @if ($showNewLetter)
        @include('layouts.components.newsletter-popup')
    @endif
    <!-- End .newsletter-popup -->
    <a id="scroll-top" href="#top" title="Top" role="button">
        <i class="icon-angle-up"></i>
    </a>
    {{-- script global --}}
    @include('layouts.partials.global')
    @include('layouts.partials.script')
    @include('layouts.components.toastr')
    {{-- script local --}}
    @yield('script')
    {{ unsetSession() }}
</body>

</html>
