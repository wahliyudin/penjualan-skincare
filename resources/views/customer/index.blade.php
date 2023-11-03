@extends('layouts.master')

@section('header')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Pelanggan
                    <small>Welcome to {{ env('APP_NAME') }}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> {{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item active">Pelanggan</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <h2><strong>All</strong> Pelanggan List</h2>
            <ul class="header-dropdown">
                <li>
                    <button class="btn btn-primary btn-round d-flex align-items-center btn-add" data-toggle="modal"
                        data-target="#customer-modal">
                        <i class="material-icons text-white">add</i>
                        <span>Tambah</span>
                    </button>
                </li>
            </ul>
        </div>
        <div class="body table-responsive">
            <table class="table table-bordered table-striped table-hover table-index">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th style="max-width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="customer-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="title" id="customer-modalLabel">Form Pelanggan</h6>
                </div>
                <div class="modal-body">
                    <form action="" class="form-model">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <input type="text" class="form-control" readonly name="code" placeholder="Kode">
                            </div>
                            <div class="col-md-12 my-2">
                                <input type="text" class="form-control" name="name" placeholder="Nama">
                            </div>
                            <div class="col-md-12 my-2">
                                <input type="text" class="form-control" name="phone_number" placeholder="Nomor HP">
                            </div>
                            <div class="col-md-12 my-2">
                                <textarea class="form-control" name="address" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-danger btn-round waves-effect" data-dismiss="modal">CLOSE</button>
                    <button type="button" data-model="" class="btn btn-primary btn-round waves-effect btn-save"
                        style="margin-left: 10px;">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}" />
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/app/customer/index.js') }}"></script>
@endpush
