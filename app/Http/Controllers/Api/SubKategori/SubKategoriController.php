<?php

namespace App\Http\Controllers\Api\SubKategori;

use App\Http\Controllers\Controller;
use App\Models\Sub_kategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    // Menampilkan Semua Data
    public function index(Request $request)
    {
        $sub_kategoris = Sub_kategori::select("kategori_id", "sub_kategori")->get();
        return response()->json([
            "data" => $sub_kategoris,
            "status" => 200,
        ]);
    }
}
