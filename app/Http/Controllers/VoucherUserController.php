<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Voucher_user;
use Illuminate\Http\Request;

class VoucherUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voucher_users = Voucher_user::with('user', 'voucher')->latest()->get();
        $total_voucher_users = Voucher_user::count();
        return view('admin.voucher_user.index', compact('voucher_users', 'total_voucher_users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vouchers = Voucher::where('label', 'berbayar')->where('status', 'aktif')->get();
        // $vouchers = $vouchers = Voucher::where('status', 'aktif')->get();
        $users = User::where('role', 'costumer')->get();
        return view('admin.voucher_user.create', compact('vouchers', 'users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
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
                return redirect()
                    ->route('voucher_user.create')->with('toast_error', 'Saldo Kurang');
            } else {
                $users->saldo -= $voucher_users->voucher->harga;
            }
            $users->save();
        }

        $voucher_users->save();
        return redirect()
            ->route('voucher_user.index')->with('toast_success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher_user  $voucher_user
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher_user $voucher_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher_user  $voucher_user
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher_user $voucher_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voucher_user  $voucher_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher_user $voucher_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher_user  $voucher_user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher_users = Voucher_user::findOrFail($id);
        $voucher_users->delete();
        return redirect()
            ->route('voucher_user.index')->with('toast_error', 'Data has been deleted');

    }
}
