<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\AddToCartRequest;
use App\Http\Requests\Transaction\StoreRequest;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index', [
            'code' => IdGenerator::generate(['table' => 'transactions', 'field' => 'code', 'length' => 7, 'prefix' => 'INV-']),
            'customers' => Customer::query()->select(['id', 'code', 'name'])->get(),
            'products' => Product::query()->select(['id', 'code', 'name'])->get(),
        ]);
    }

    public function datatable(Request $request)
    {
        $data = Cart::query()->where('code', $request->code)->get();
        return datatables()->of($data)
            ->addColumn('product', function (Cart $cart) {
                return $cart->product?->name;
            })
            ->addColumn('price', function (Cart $cart) {
                return number_format($cart->product?->price, 0, ',', '.');
            })
            ->addColumn('amount', function (Cart $cart) {
                return $cart->quantity;
            })
            ->addColumn('sub_total', function (Cart $cart) {
                return number_format($cart->quantity * $cart->product?->price, 0, ',', '.');
            })
            ->addColumn('action', function (Cart $cart) {
                return view('transaction.action', compact('cart'))->render();
            })
            ->make();
    }

    public function product($code, $id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            $stock = $product->stock;
            $carts = Cart::query()->where('code', $code)->where('product_id', $id)->get();
            foreach ($carts as $cart) {
                $stock -= $cart->quantity;
            }
            return response()->json([
                'price' => number_format($product->price, 0, ',', '.'),
                'stock' => $stock
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editCart($id)
    {
        try {
            $cart = Cart::query()->with('product')->findOrFail($id);
            return response()->json([
                'product_id' => $cart->product_id,
                'product_price' => $cart->product?->price,
                'quantity' => $cart->quantity,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addToCart(AddToCartRequest $request)
    {
        try {
            Cart::query()->updateOrCreate([
                'id' => $request->id
            ], [
                'code' => $request->code,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
            return response()->json([
                'title' => 'Tersimpan',
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroyCart($id)
    {
        try {
            $cart = Cart::query()->findOrFail($id);
            $cart->delete();
            return response()->json([
                'title' => 'Terhapus',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $transaction = Transaction::query()->with('carts')->create([
                    'code' => $request->code,
                    'customer_id' => $request->customer_id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($transaction->carts->count() <= 0) {
                    throw ValidationException::withMessages(['Cart masih kosong!']);
                }
                $carts = [];
                foreach ($transaction->carts as $cart) {
                    $carts[] = [
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                    ];
                    $product = Product::query()->find($cart->product_id);
                    $product->update([
                        'stock' => $product->stock - $cart->quantity
                    ]);
                }
                $transaction->details()->createMany($carts);
                $transaction->carts()->delete();
            });
            return response()->json([
                'title' => 'Tersimpan!',
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
