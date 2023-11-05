<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function __invoke()
    {
        return Pdf::loadView('report.admin.pdf', [
            'data' => User::query()->get()
        ])->stream();
    }
}
