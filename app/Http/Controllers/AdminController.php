<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function datatable()
    {
        $data = User::query()->get();
        return datatables()->of($data)
            ->addColumn('action', function (User $user) {
                return view('admin.action', compact('user'))->render();
            })
            ->make();
    }

    public function nextCode()
    {
        try {
            $code = IdGenerator::generate(['table' => 'users', 'field' => 'code', 'length' => 7, 'prefix' => 'ADM-']);
            return response()->json($code);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            User::query()->create([
                'code' => $request->code,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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
            $user = User::query()->findOrFail($id);
            return response()->json([
                'code' => $user->code,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $user = User::query()->findOrFail($id);
            $user->update([
                'code' => $request->code,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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
            $user = User::query()->findOrFail($id);
            $user->delete();
            return response()->json([
                'title' => 'Terhapus!',
                'message' => 'Data Anda berhasil dihapus!',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
