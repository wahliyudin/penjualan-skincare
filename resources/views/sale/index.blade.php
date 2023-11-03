@extends('layouts.master')

@section('header')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Penjualan
                    <small>Welcome to {{ env('APP_NAME') }}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> {{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item active">Penjualan</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <h2><strong>All</strong> Penjualan List</h2>
            <ul class="header-dropdown">
                <li>
                    <a href="{{ route('transaction') }}" class="btn btn-primary btn-round d-flex align-items-center">
                        <i class="material-icons text-white">add</i>
                        <span>Tambah</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="body table-responsive">
            <table class="table table-bordered table-striped table-hover table-index">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Admin</th>
                        <th>Pelanggan</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script src="{{ asset('assets/js/app/sale/index.js') }}"></script>
@endpush
