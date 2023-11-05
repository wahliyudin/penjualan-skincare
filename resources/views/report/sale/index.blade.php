@extends('layouts.master')

@section('header')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Laporan Data Penjualan
                    <small>Welcome to {{ env('APP_NAME') }}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> {{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item active">Laporan Data Penjualan</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <h2><strong>All</strong> Laporan Data Penjualan </h2>
        </div>
        <div class="body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="container">
                        <div class="alert-icon">
                            <i class="zmdi zmdi-block"></i>
                        </div>
                        {{ implode(', ', $errors->all(':message')) }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="zmdi zmdi-close"></i>
                            </span>
                        </button>
                    </div>
                </div>
            @endif
            <form action="{{ route('report.sale.export-by-period') }}" method="get">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" class="form-control" value="{{ old('start_date') }}" name="start_date"
                                placeholder="Tanggal Awal">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" class="form-control" value="{{ old('end_date') }}" name="end_date"
                                placeholder="Tanggal Akhir">
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button style="submit" class="btn btn-info btn-round">Cetak Pertanggal</button>
                    <a target="_blank" href="{{ route('report.sale.export') }}" class="btn btn-warning btn-round">Cetak
                        Penjualan</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
