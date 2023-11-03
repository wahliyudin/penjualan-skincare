<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index()
    {
        return view('sale.index');
    }

    public function datatable()
    {
        $data = TransactionDetail::query()->with(['product', 'transaction' => function ($query) {
            $query->with(['admin', 'customer']);
        }])->get();
        return datatables()->of($data)
            ->addColumn('date', function (TransactionDetail $transactionDetail) {
                return Carbon::parse($transactionDetail->transaction?->created_at)->format('d-m-Y');
            })
            ->addColumn('admin', function (TransactionDetail $transactionDetail) {
                return $transactionDetail->transaction?->admin?->name;
            })
            ->addColumn('customer', function (TransactionDetail $transactionDetail) {
                return $transactionDetail->transaction?->customer?->name;
            })
            ->addColumn('product', function (TransactionDetail $transactionDetail) {
                return $transactionDetail->product?->name;
            })
            ->addColumn('price', function (TransactionDetail $transactionDetail) {
                return number_format($transactionDetail->product?->price, 0, ',', '.');
            })
            ->addColumn('amount', function (TransactionDetail $transactionDetail) {
                return $transactionDetail->quantity;
            })
            ->addColumn('sub_total', function (TransactionDetail $transactionDetail) {
                return number_format($transactionDetail->product?->price  * $transactionDetail->quantity, 0, ',', '.');
            })
            ->make();
    }
}
