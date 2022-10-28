<?php

namespace App\Http\Controllers\Api\kategori;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan Semua Data
    public function index()
    {
        $kategoris = kategori::select("id", "name")->get();
        return response()->json([
            "data" => $kategoris,
            "status" => 200,
        ]);
    }

    // Membuat Data Baru
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'name' => 'required|unique:kategoris',
        ]);

        $kategoris = new Kategori();
        $kategoris->name = $request->name;
        $kategoris->save();

        return response()->json([
            "status" => 201,
            "messaage" => "succesfully created Kategori",
        ]);
    }

    // Menampilkan Data berdasakarkan id
    public function show($id)
    {
        $kategoris = Kategori::findOrFail($id);
        return response()->json([
            "data" => $kategoris,
            "status" => 200,
        ]);
    }

    // Mengedit Data
    public function update(Request $request, $id)
    {
        $kategoris = Kategori::findOrFail($id);

        if ($request->name != $kategoris->name) {
            $rules['name'] = 'required|unique:kategoris';
        }

        $validasiData = $request->validate($rules);
        $kategoris->name = $request->name;
        $kategoris->save();

        return response()->json([
            "status" => 201,
            "messaage" => "succesfully updated Kategori",
        ]);
    }

    // Menghapus Data
    public function destroy($id)
    {
        $kategoris = Kategori::findOrFail($id);
        $kategoris->delete();

        return response()->json([
            "status" => 201,
            "messaage" => "succesfully deleted Kategori",
        ]);
    }
}
