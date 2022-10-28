<?php

namespace App\Http\Controllers\Api\history;

use App\Http\Controllers\Controller;
use App\Models\History;

class HistoryController extends Controller
{
    // Menampilkan Semua Data
    public function index()
    {
        $histories = History::select("id", "kode_transaksi", "nama_pembeli", "nama_produk", "waktu_pemesanan", "status")->with("transaksi")->get();
        return response()->json([
            "data" => $histories,
            "status" => 200,
        ]);
    }

    // Menampilkan Data berdasakarkan id
    public function show($id)
    {
        $histories = History::findOrFail($id);
        return response()->json([
            "data" => $histories,
            "status" => 200,
        ]);
    }

    // Menghapus Data
    public function destroy($id)
    {
        $histories = History::findOrFail($id);
        $histories->delete();

        return response()->json([
            "status" => 201,
            "messaage" => "succesfully deleted History",
        ]);
    }
}
