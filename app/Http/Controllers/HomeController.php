<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\User;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'total_admin' => User::query()->count(),
            'total_customer' => Customer::query()->count(),
            'total_product' => Product::query()->count(),
            'total_sale' => TransactionDetail::query()->count(),
        ]);
    }
}
