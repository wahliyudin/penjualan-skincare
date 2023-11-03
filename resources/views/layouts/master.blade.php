<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">
</head>

<body class="theme-blush">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30">
                <img class="zmdi-hc-spin" src="{{ asset('assets/images/logo.svg') }}" width="48" height="48"
                    alt="Oreo">
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <div class="overlay"></div>
    @include('layouts.master.navbar')
    @include('layouts.master.sidebar')
    <section class="content">
        @yield('header')
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
</body>
