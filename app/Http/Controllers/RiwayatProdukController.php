<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Riwayat_produk;
use Illuminate\Http\Request;

class RiwayatProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayat_produks = Riwayat_produk::with('produk')->latest()->get();
        $total_riwayat_produks = Riwayat_produk::count();
        return view('admin.riwayat_produk.index', compact('riwayat_produks', 'total_riwayat_produks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::all();
        return view('admin.produk.index', compact('produks'));

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
            'produk_id' => 'required',
            'type' => 'required',
            'qty' => 'required',
            'note' => 'required',
            'waktu_riwayat' => 'required',
        ]);

        $riwayat_produks = new Riwayat_produk();
        $riwayat_produks->produk_id = $request->produk_id;
        $riwayat_produks->type = $request->type;
        $riwayat_produks->qty = $request->qty;
        $riwayat_produks->note = $request->note;
        $riwayat_produks->waktu_riwayat = $request->waktu_riwayat;
        $produks = Produk::findOrFail($riwayat_produks->produk_id);
        if ($riwayat_produks->type == 'masuk') {
            $produks->stok += $riwayat_produks->qty;
        } elseif ($riwayat_produks->type == 'keluar') {
            if ($produks->stok < $riwayat_produks->qty) {
                return redirect()
                    ->route('produk.index')->with('toast_error', 'Stok Kurang');
            } else {
                $produks->stok -= $riwayat_produks->qty;

            }
        }

        $produks->save();
        $riwayat_produks->save();
        return redirect()
            ->route('produk.index')->with('toast_success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Riwayat_produk  $riwayat_produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Riwayat_produk  $riwayat_produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Riwayat_produk  $riwayat_produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Riwayat_produk  $riwayat_produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $riwayat_produks = Produk::findOrFail($id);
        $riwayat_produks->delete();
        return redirect()
            ->route('riwayat_produk.index')->with('toast_error', 'Data has been deleted');

    }
}
