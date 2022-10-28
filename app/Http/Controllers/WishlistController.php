<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::with('produk', 'user')->latest()->get();
        // $wishlists = Wishlist::with('produk', 'user')->where('user_id', auth()->user()->id)->latest()->get();
        $total_wishlists = Wishlist::count();
        // $total_wishlists = Wishlist::where('user_id', auth()->user()->id)->count();
        return view('admin.wishlist.index', compact('wishlists', 'total_wishlists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::all();
        $users = User::all();
        return view('admin.wishlist.create', compact('produks', 'users'));

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
            'produk_id' => 'required',
        ]);

        $wishlists = new Wishlist();
        $wishlists->user_id = $request->user_id;
        $wishlists->produk_id = $request->produk_id;
        $wishlists->save();
        return redirect()
            ->route('wishlist.index')->with('toast_success', 'Data has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wishlists = Wishlist::findOrFail($id);
        $produks = Produk::all();
        $users = User::all();
        return view('admin.wishlist.edit', compact('wishlists', 'produks', 'users'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $validated = $request->validate([
            'user_id' => 'required',
            'produk_id' => 'required',
        ]);

        $wishlists = Wishlist::findOrFail($id);
        $wishlists->user_id = $request->user_id;
        $wishlists->produk_id = $request->produk_id;
        $wishlists->save();
        return redirect()
            ->route('wishlist.index')->with('toast_info', 'Data has been edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlists = Wishlist::findOrFail($id);
        $wishlists->delete();
        return redirect()
            ->route('wishlist.index')->with('toast_error', 'Data has been deleted');

    }
}
