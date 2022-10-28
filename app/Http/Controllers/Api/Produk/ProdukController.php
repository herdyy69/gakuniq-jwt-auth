<?php

namespace App\Http\Controllers\Api\Produk;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan Semua Data
    public function index(Request $request)
    {
        $produks = Produk::select("sub_kategori_id", "nama_produk", "harga", "stok", "diskon", "deskripsi", "gambar_produk1", "gambar_produk2", "gambar_produk3")->get();
        return response()->json([
            "data" => $produks,
            "status" => 200,
        ]);
    }

    // Menampilkan Data berdasakarkan id
    public function show($id)
    {
        $produks = Produk::findOrFail($id);
        return response()->json([
            "data" => $produks,
            "status" => 200,
        ]);

    }
}
