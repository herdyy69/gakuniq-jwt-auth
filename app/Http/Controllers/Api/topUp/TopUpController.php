<?php

namespace App\Http\Controllers\Api\topUp;

use App\Http\Controllers\Controller;
use App\Models\TopUp;
use App\Models\User;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    public function index()
    {
        $top_ups = TopUp::select("id", "user_id", "jumlah_saldo", "metode_pembayaran")->with('user')->get();
        return response()->json([
            "data" => $top_ups,
            "status" => 200,
        ]);
    }

    // Membuat Data Baru
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'user_id' => 'required',
            'jumlah_saldo' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        $top_ups = new TopUp();
        $top_ups->user_id = $request->user_id;
        $top_ups->jumlah_saldo = $request->jumlah_saldo;
        $top_ups->metode_pembayaran = $request->metode_pembayaran;

        $users = User::findOrFail($top_ups->user_id);
        $users->saldo += $top_ups->jumlah_saldo;
        $users->save();
        $top_ups->save();

        return response()->json([
            "status" => 201,
            "messaage" => "succesfully created Top Up",
        ]);
    }

    // Menghapus Data
    public function destroy($id)
    {
        $top_ups = TopUp::findOrFail($id);
        $top_ups->delete();

        return response()->json([
            "status" => 201,
            "messaage" => "succesfully deleted TopUp",
        ]);
    }
}
