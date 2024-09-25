<?php

namespace App\Http\Controllers\Api;

use App\Models\Mutasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::with(['user', 'barang'])->get();
        return response()->json([
            "success" => true,
            "message" => "Mutasi list retrieved successfully.",
            "data" => $mutasis
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barangs,id',
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required',
            'jumlah' => 'required|integer',
        ]);

        $mutasi = Mutasi::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "Mutasi created successfully.",
            "data" => $mutasi
        ], 201);
    }

    public function show($id)
    {
        $mutasi = Mutasi::with(['user', 'barang'])->findOrFail($id);
        return response()->json([
            "success" => true,
            "message" => "Mutasi retrieved successfully.",
            "data" => $mutasi
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $mutasi->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Mutasi updated successfully.",
            "data" => $mutasi
        ], 200);
    }

    public function destroy($id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $mutasi->delete();

        return response()->json([
            "success" => true,
            "message" => "Mutasi deleted successfully.",
            "data" => $mutasi
        ], 200);
    }
}