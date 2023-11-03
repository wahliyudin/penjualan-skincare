<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Models\Customer;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function datatable()
    {
        $data = Customer::query()->get();
        return datatables()->of($data)
            ->addColumn('action', function (Customer $customer) {
                return view('customer.action', compact('customer'))->render();
            })
            ->make();
    }

    public function nextCode()
    {
        try {
            $code = IdGenerator::generate(['table' => 'customers', 'field' => 'code', 'length' => 7, 'prefix' => 'CUS-']);
            return response()->json($code);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            Customer::query()->create([
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
            $customer = Customer::query()->findOrFail($id);
            return response()->json([
                'code' => $customer->code,
                'name' => $customer->name,
                'phone_number' => $customer->phone_number,
                'address' => $customer->address,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $customer = Customer::query()->findOrFail($id);
            $customer->update([
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
            $customer = Customer::query()->findOrFail($id);
            $customer->delete();
            return response()->json([
                'title' => 'Terhapus!',
                'message' => 'Data Anda berhasil dihapus!',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
