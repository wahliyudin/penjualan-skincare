@extends('layouts.master')

@section('header')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Barang
                    <small>Welcome to {{ env('APP_NAME') }}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> {{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item active">Barang</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <h2><strong>All</strong> Barang List</h2>
            <ul class="header-dropdown">
                <li>
                    <button class="btn btn-primary btn-round d-flex align-items-center btn-add" data-toggle="modal"
                        data-target="#product-modal">
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
                        <th>Pemasok</th>
                        <th>Harga</th>
                        <th>Stok</th>
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
    <div class="modal fade" id="product-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="title" id="product-modalLabel">Form Barang</h6>
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
                            <div class="col-md-12 mt-2 mb-3">
                                <select class="form-control" name="supplier_id">
                                    <option selected disabled value="">-- Pemasok --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->getKey() }}">
                                            {{ $supplier->code . ' - ' . $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 my-2">
                                <input type="text" class="form-control money" name="price" placeholder="Harga">
                            </div>
                            <div class="col-md-12 my-2">
                                <input type="number" class="form-control" name="stock" placeholder="Stok">
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
    <link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/app/product/index.js') }}"></script>
@endpush
