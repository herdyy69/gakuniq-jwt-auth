<?php

namespace App\Http\Controllers\Api\Voucher;

use App\Http\Controllers\Controller;
use App\Models\Voucher;

class VoucherController extends Controller
{
    // Menampilkan Semua Data
    public function index()
    {
        $vouchers = Voucher::select("id", "kode_voucher", "harga", "diskon", "label", "waktu_mulai", "waktu_berakhir", "status")->get();
        return response()->json([
            "data" => $vouchers,
            "status" => 200,
        ]);
    }
}
