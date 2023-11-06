@extends('layouts.master')

@section('header')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Dashboard
                    <small>Welcome to {{ env('APP_NAME') }}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> {{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon xl-slategray">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="content">
                            <div class="text">Data Admin</div>
                            <h5 class="number count-to" data-from="0" data-to="{{ $total_admin }}" data-speed="1000"
                                data-fresh-interval="700">{{ $total_admin }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon xl-slategray">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="content">
                            <div class="text">Data Pelanggan</div>
                            <h5 class="number count-to" data-from="0" data-to="{{ $total_customer }}" data-speed="1000"
                                data-fresh-interval="700">{{ $total_customer }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon xl-slategray">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <div class="content">
                            <div class="text">Data Barang</div>
                            <h5 class="number count-to" data-from="0" data-to="{{ $total_product }}" data-speed="1000"
                                data-fresh-interval="700">{{ $total_product }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon xl-slategray">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div class="content">
                            <div class="text">Data Penjualan</div>
                            <h5 class="number count-to" data-from="0" data-to="{{ $total_sale }}" data-speed="1000"
                                data-fresh-interval="700">{{ $total_sale }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
