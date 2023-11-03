<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Models\Supplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'suppliers' => Supplier::query()->select(['id', 'code', 'name'])->get()
        ]);
    }

    public function datatable()
    {
        $data = Product::query()->get();
        return datatables()->of($data)
            ->addColumn('action', function (Product $product) {
                return view('product.action', compact('product'))->render();
            })
            ->make();
    }

    public function nextCode()
    {
        try {
            $code = IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 7, 'prefix' => 'BRG-']);
            return response()->json($code);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            Product::query()->create([
                'code' => $request->code,
                'name' => $request->name,
                'price' => str($request->price)->remove('.')->value(),
                'stock' => $request->stock,
                'supplier_id' => $request->supplier_id,
            ]);
            return response()->json([
                'title' => 'Tersimpan!',
                'message' => 'Data Anda berhasil disimpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            return response()->json([
                'code' => $product->code,
                'name' => $product->name,
                'price' => number_format($product->price, '.', ','),
                'stock' => $product->stock,
                'supplier_id' => $product->supplier_id,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            $product->update([
                'code' => $request->code,
                'name' => $request->name,
                'price' => str($request->price)->remove('.')->value(),
                'stock' => $request->stock,
                'supplier_id' => $request->supplier_id,
            ]);
            return response()->json([
                'title' => 'Terubah!',
                'message' => 'Data Anda berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            $product->delete();
            return response()->json([
                'title' => 'Terhapus!',
                'message' => 'Data Anda berhasil dihapus!',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
