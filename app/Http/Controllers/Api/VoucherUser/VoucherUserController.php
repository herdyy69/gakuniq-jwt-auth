<?php

namespace App\Http\Controllers\Api\VoucherUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher_user;
use Illuminate\Http\Request;

class VoucherUserController extends Controller
{
    // Menampilkan Semua Data
    public function index()
    {
        $voucher_users = Voucher_user::select("user_id", "voucher_id", "metode_pembayaran")->with('user', 'voucher')->get();
        $jumlah_voucher_users = Voucher_user::count();
        return response()->json([
            "data" => $voucher_users,
            "jumlah_voucher_user" => $jumlah_voucher_users,
            "status" => 200,
        ]);
    }

    // Membuat Data Baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'voucher_id' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        $voucher_users = new Voucher_user();
        $voucher_users->user_id = $request->user_id;
        $voucher_users->voucher_id = $request->voucher_id;
        $voucher_users->metode_pembayaran = $request->metode_pembayaran;

        // saldo
        $users = User::findOrFail($voucher_users->user_id);
        if ($voucher_users->metode_pembayaran == 'gakuniq wallet') {
            if ($users->saldo < $voucher_users->voucher->harga) {
                return response()->json(["message" => "saldo kurang"]);
            } else {
                $users->saldo -= $voucher_users->voucher->harga;
            }
            $users->save();
        }

        $voucher_users->save();

        return response()->json([
            "status" => 201,
            "messaage" => "succesfully created Voucher User",
        ]);
    }
}
