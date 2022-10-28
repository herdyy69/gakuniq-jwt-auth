<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Models\User;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top_ups = TopUp::with('user')->latest()->get();
        $total_top_ups = TopUp::count();
        return view('admin.top_up.index', compact('top_ups', 'total_top_ups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'costumer')->get();
        return view('admin.top_up.create', compact('users'));
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
        return redirect()
            ->route('top_up.index')->with('toast_success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show(TopUp $topUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function edit(TopUp $topUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopUp $topUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopUp $topUp)
    {
        //
    }
}
