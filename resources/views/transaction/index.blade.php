@extends('layouts.master')

@section('header')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Transaksi
                    <small>Welcome to {{ env('APP_NAME') }}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> {{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item active">Transaksi</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="body">
            <form action="" class="form-transaction">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control mt-1" name="code" value="{{ $code }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control mt-1" name="date" value="{{ now()->format('Y-m-d') }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="customer_id">
                            <option selected disabled value="">-- Pelanggan --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->getKey() }}">
                                    {{ $customer->code . ' - ' . $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row pt-4 mt-4" style="border-top: 2px solid rgba(0, 0, 0, 0.486);">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <input type="search" class="form-control" name="search" placeholder="Search">
                            </div>
                            <button type="button"
                                class="btn btn-primary btn-round btn-sm d-flex align-items-center btn-add"
                                data-toggle="modal" data-target="#cart-modal">
                                <i class="material-icons text-white">add</i>
                                <span>Tambah</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-index">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th style="max-width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #ff8ea2;" class="text-white">
                                        <td colspan="3" class="text-center">Grand Total</td>
                                        <td class="grand-total ">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-primary btn-round btn-save-transaction">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="cart-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="title" id="cart-modalLabel">Form Cart</h6>
                </div>
                <div class="modal-body">
                    <form action="" class="form-model">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <select class="form-control" name="product_id">
                                    <option selected disabled value="">-- Barang --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->getKey() }}">
                                            {{ $product->code . ' - ' . $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 my-2">
                                <input type="text" class="form-control money" name="price" disabled
                                    placeholder="Harga">
                            </div>
                            <div class="col-md-12 my-2">
                                <input type="number" class="form-control" name="quantity" placeholder="Jumlah">
                            </div>
                            <div class="col-md-12 my-2">
                                <input type="text" class="form-control money" name="sub_total" disabled
                                    placeholder="Sub Total">
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
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/js/app/transaction/index.js') }}"></script>
@endpush
