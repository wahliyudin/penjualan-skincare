<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function __invoke()
    {
        return Pdf::loadView('report.customer.pdf', [
            'data' => Customer::query()->get()
        ])->stream();
    }
}
