<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return response()->json([
            "success" => true,
            "message" => "Barang list retrieved successfully.",
            "data" => $barangs
        ], 200);
    }

    public function showHistory($id)
    {
        $barang = Barang::with('mutasis')->findOrFail($id);
        return response()->json([
            "success" => true,
            "message" => "Barang history retrieved successfully.",
            "data" => $barang
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode' => 'required|unique:barangs',
            'kategori' => 'required',
            'lokasi' => 'required',
        ]);

        $barang = Barang::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "Barang created successfully.",
            "data" => $barang
        ], 201);
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json([
            "success" => true,
            "message" => "Barang retrieved successfully.",
            "data" => $barang
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode' => 'required|unique:barangs,kode,' . $id,
            'kategori' => 'required',
            'lokasi' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Barang updated successfully.",
            "data" => $barang
        ], 200);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json([
            "success" => true,
            "message" => "Barang deleted successfully.",
            "data" => $barang
        ], 200);
    }
}
