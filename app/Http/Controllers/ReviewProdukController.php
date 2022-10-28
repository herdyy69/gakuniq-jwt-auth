<?php

namespace App\Http\Controllers;

use App\Models\Review_produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ReviewProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review_produks = Review_produk::with('transaksi')->latest()->get();
        $total_review_produks = Review_produk::count();
        return view('admin.review_produk.index', compact('review_produks', 'total_review_produks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaksis = Transaksi::all();
        return view('admin.review_produk.create', compact('transaksis'));

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
            'transaksi_id' => 'required',
            'status' => 'required',
            'komen' => 'required',
        ]);

        $review_produks = new Review_produk();
        $review_produks->transaksi_id = $request->transaksi_id;
        $review_produks->status = $request->status;
        $review_produks->komen = $request->komen;
        $review_produks->save();
        return redirect()
            ->route('review_produk.index')->with('toast_success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review_produk  $review_produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review_produks = Review_Produk::findOrFail($id);
        // $kategoris = Kategori::all();
        return view('admin.review_produk.show', compact('review_produks'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review_produk  $review_produk
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
     * @param  \App\Models\Review_produk  $review_produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review_produk  $review_produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review_produks = Review_Produk::findOrFail($id);
        $review_produks->delete();
        return redirect()
            ->route('review_produk.index')->with('toast_error', 'Data has been deleted');

    }
}
