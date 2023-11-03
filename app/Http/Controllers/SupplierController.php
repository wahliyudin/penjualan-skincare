<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Models\Supplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index');
    }

    public function datatable()
    {
        $data = Supplier::query()->get();
        return datatables()->of($data)
            ->addColumn('action', function (Supplier $supplier) {
                return view('supplier.action', compact('supplier'))->render();
            })
            ->make();
    }

    public function nextCode()
    {
        try {
            $code = IdGenerator::generate(['table' => 'suppliers', 'field' => 'code', 'length' => 7, 'prefix' => 'SPR-']);
            return response()->json($code);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            Supplier::query()->create([
                'code' => $request->code,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
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
            $supplier = Supplier::query()->findOrFail($id);
            return response()->json([
                'code' => $supplier->code,
                'name' => $supplier->name,
                'phone_number' => $supplier->phone_number,
                'address' => $supplier->address,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $supplier = Supplier::query()->findOrFail($id);
            $supplier->update([
                'code' => $request->code,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
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
            $supplier = Supplier::query()->findOrFail($id);
            $supplier->delete();
            return response()->json([
                'title' => 'Terhapus!',
                'message' => 'Data Anda berhasil dihapus!',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
