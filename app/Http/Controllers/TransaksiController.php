<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Voucher_user;
use DB;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::with('keranjang', 'voucher', 'voucher_user')->latest()->get();
        // $keranjangs = Keranjang::with('produk', 'user')->where('user_id', auth()->user()->id)->latest()->get();
        $total_transaksis = Transaksi::count();
        // $total_keranjangs = Keranjang::where('user_id', auth()->user()->id)->count();
        return view('admin.transaksi.index', compact('transaksis', 'total_transaksis'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keranjangs = Keranjang::all();
        $voucher_users = Voucher_user::all();
        $vouchers = Voucher::where('status', 'aktif')->where('label', 'gratis')->get();
        return view('admin.transaksi.create', compact('keranjangs', 'vouchers', 'voucher_users'));
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
            'keranjang_id' => 'required',
            'metode_pembayaran' => 'required',
            'waktu_pemesanan' => 'required',
            'kode_transaksi' => 'unique:transaksis',
        ]);

        $transaksis = new Transaksi();
        $kode_transaksis = DB::table('transaksis')->select(DB::raw('MAX(RIGHT(kode_transaksi,3)) as kode'));
        if ($kode_transaksis->count() > 0) {
            foreach ($kode_transaksis->get() as $kode_transaksi) {
                $x = ((int) $kode_transaksi->kode) + 1;
                $kode = sprintf("%03s", $x);
            }
        } else {
            $kode = "001";
        }
        $transaksis->kode_transaksi = 'GNQ-' . date('dmy') . $kode;
        $transaksis->keranjang_id = $request->keranjang_id;
        $transaksis->metode_pembayaran = $request->metode_pembayaran;
        $transaksis->waktu_pemesanan = $request->waktu_pemesanan;
        $transaksis->voucher_id = $request->voucher_id;

        if ($transaksis->voucher_id == '') {
            $diskon = 0;
        } else {
            $diskon = (($transaksis->voucher->diskon * $transaksis->keranjang->total_harga) / 100);
        }
        $transaksis->total_harga = $transaksis->keranjang->total_harga - $diskon;

        // stok produk
        $produks = Produk::findOrFail($transaksis->keranjang->produk_id);
        if ($produks->stok < $transaksis->keranjang->jumlah) {
            return redirect()
                ->route('transaksi.create')->with('toast_error', 'Stok Kurang');
        } else {
            $produks->stok -= $transaksis->keranjang->jumlah;
        }
        $produks->save();

        // score
        $users = User::findOrFail($transaksis->keranjang->user_id);
        if ($transaksis->total_harga >= 100000 && $transaksis->total_harga < 199999) {
            $users->score += 10;
        } elseif ($transaksis->total_harga >= 200000 && $transaksis->total_harga < 299999) {
            $users->score += 20;
        } elseif ($transaksis->total_harga >= 300000 && $transaksis->total_harga < 399999) {
            $users->score += 30;
        } elseif ($transaksis->total_harga >= 400000) {
            $users->score += 50;
        }
        $users->save();

        // saldo
        if ($transaksis->metode_pembayaran == 'gakuniq wallet') {
            if ($users->saldo < $transaksis->total_harga) {
                return redirect()
                    ->route('transaksi.create')->with('toast_error', 'Saldo Kurang');
            } else {
                $users->saldo -= $transaksis->total_harga;
            }
            $users->save();
        }

        // History
        $histories = new History();
        $histories->kode_transaksi = $transaksis->kode_transaksi;
        $histories->nama_pembeli = $transaksis->keranjang->user->name;
        $histories->nama_produk = $transaksis->keranjang->produk->nama_produk;
        $histories->waktu_pemesanan = $transaksis->waktu_pemesanan;
        $histories->save();

        $transaksis->save();
        return redirect()
            ->route('transaksi.index')->with('toast_success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksis = Transaksi::findOrFail($id);
        $keranjangs = Keranjang::all();
        return view('admin.transaksi.show', compact('keranjangs', 'transaksis'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksis = Transaksi::findOrFail($id);
        $keranjangs = Keranjang::all();
        $vouchers = Voucher::where('status', 'aktif')->get();
        return view('admin.transaksi.edit', compact('keranjangs', 'transaksis', 'vouchers'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksis = Transaksi::findOrFail($id);

        //validasi
        $rules = [
            'keranjang_id' => 'required',
            'metode_pembayaran' => 'required',
            'waktu_pemesanan' => 'required',
        ];

        if ($request->kode_transaksi != $transaksis->kode_transaksi) {
            $rules['kode_transaksi'] = 'unique:transaksis';
        }
        $validasiData = $request->validate($rules);

        $transaksis->kode_transaksi = $request->kode_transaksi;
        $transaksis->keranjang_id = $request->keranjang_id;
        $transaksis->metode_pembayaran = $request->metode_pembayaran;
        $transaksis->waktu_pemesanan = $request->waktu_pemesanan;
        $transaksis->voucher_id = $request->voucher_id;
        if ($transaksis->voucher_id == '') {
            $diskon = 0;
        } else {
            $diskon = (($transaksis->voucher->diskon * $transaksis->keranjang->total_harga) / 100);
        }
        $transaksis->total_harga = $transaksis->keranjang->total_harga - $diskon;
        $transaksis->save();
        return redirect()
            ->route('transaksi.index')->with('toast_success', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksis = Transaksi::findOrFail($id);
        $transaksis->delete();
        return redirect()
            ->route('transaksi.index')->with('toast_error', 'Data has been deleted');

    }
}
