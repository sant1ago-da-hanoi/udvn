<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="HNAM">
    <meta name="generator" content="whatever">
    <title>CMS - @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}">

    @yield('style')

    <!-- Core css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="layout">
    <div class="vertical-layout">
        @include('partials.header')
        @include('partials.sidebar')
        @yield('content')
    </div>
</div>
@yield('modal')
<!-- Core Vendors JS -->
<script src="{{ asset('assets/js/vendors.min.js') }}"></script>

@yield('scripts')

<!-- Core JS -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>
</html>
