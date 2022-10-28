<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $histories = History::with('transaksi')->latest()->get();
        $total_histories = History::count();
        return view('admin.history.index', compact('histories', 'total_histories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $transaksis = Transaksi::all();
        return view('admin.history.create', compact('transaksis'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //validasi
    //     $validated = $request->validate([
    //         'transaksi_id' => 'required',
    //         'status' => 'required',
    //     ]);

    //     $histories = new History();
    //     $histories->transaksi_id = $request->transaksi_id;
    //     $histories->status = $request->status;
    //     $histories->save();
    //     return redirect()
    //         ->route('history.index')->with('toast_success', 'Data has been added');

    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $histories = History::findOrFail($id);
        return view('admin.history.edit', compact('histories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $validated = $request->validate([
            // 'kode_transaksi' => 'required',
            'nama_pembeli' => 'required',
            'nama_produk' => 'required',
            'waktu_pemesanan' => 'required',
            'status' => 'required',
        ]);

        $histories = History::findOrFail($id);
        $histories->kode_transaksi = $request->kode_transaksi;
        $histories->nama_pembeli = $request->nama_pembeli;
        $histories->nama_produk = $request->nama_produk;
        $histories->waktu_pemesanan = $request->waktu_pemesanan;
        $histories->status = $request->status;
        $histories->save();
        return redirect()
            ->route('history.index')->with('toast_info', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $histories = History::findOrFail($id);
        $histories->delete();
        return redirect()
            ->route('history.index')->with('toast_error', 'Data has been deleted');

    }
}
