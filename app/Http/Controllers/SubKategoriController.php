<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Sub_kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_kategoris = Sub_kategori::with('kategori')->latest()->get();
        $total_sub_kategoris = Sub_kategori::count();
        return view('admin.sub_kategori.index', compact('sub_kategoris', 'total_sub_kategoris'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.sub_kategori.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'kategori_id' => 'required',
            'sub_kategori' => 'required',
        ]);

        $sub_kategoris = new Sub_kategori();
        $sub_kategoris->kategori_id = $request->kategori_id;
        $sub_kategoris->sub_kategori = $request->sub_kategori;
        $sub_kategoris->save();
        return redirect()
            ->route('sub_kategori.index')->with('toast_success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sub_kategori  $sub_kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sub_kategori  $sub_kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_kategoris = sub_kategori::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.sub_kategori.edit', compact('kategoris', 'sub_kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sub_kategori  $sub_kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $validated = $request->validate([
            'kategori_id' => 'required',
            'sub_kategori' => 'required',
        ]);

        $sub_kategoris = sub_kategori::findOrFail($id);
        $sub_kategoris->kategori_id = $request->kategori_id;
        $sub_kategoris->sub_kategori = $request->sub_kategori;
        $sub_kategoris->save();
        return redirect()
            ->route('sub_kategori.index')->with('toast_info', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub_kategori  $sub_kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_kategoris = Sub_kategori::findOrFail($id);
        $sub_kategoris->delete();
        return redirect()
            ->route('sub_kategori.index')->with('toast_error', 'Data has been deleted');

    }
}
