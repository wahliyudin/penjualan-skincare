<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function __invoke()
    {
        return Pdf::loadView('report.product.pdf', [
            'data' => Product::query()->get()
        ])->stream();
    }
}
