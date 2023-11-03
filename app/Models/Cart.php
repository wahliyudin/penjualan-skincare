<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'product_id',
        'quantity',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'code', 'code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
