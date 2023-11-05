<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index()
    {
        return view('report.sale.index');
    }

    public function exportByPeriod(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'start_date' => ['required'],
            'end_date' => ['required'],
        ], [
            'start_date.required' => 'Tanggal Awal wajib diisi',
            'end_date.required' => 'Tanggal Akhir wajib diisi',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate->getMessageBag());
        }
        return Pdf::loadView('report.sale.pdf-by-period', [
            'data' => TransactionDetail::query()
                ->whereBetween('created_at', [$request->start_date, Carbon::parse($request->end_date)->addDay()->format('Y-m-d')])
                ->with(['product', 'transaction' => function ($query) {
                    $query->with(['admin', 'customer']);
                }])->get(),
            'start_date' => Carbon::parse($request->start_date)->translatedFormat('d F Y'),
            'end_date' => Carbon::parse($request->end_date)->translatedFormat('d F Y'),
        ])->stream();
    }

    public function export()
    {
        return Pdf::loadView('report.sale.pdf', [
            'data' => TransactionDetail::query()->with(['product', 'transaction' => function ($query) {
                $query->with(['admin', 'customer']);
            }])->get()
        ])->stream();
    }
}
