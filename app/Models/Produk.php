<?php

namespace App\Models;

use App\Models\Keranjang;
use App\Models\Riwayat_produk;
use App\Models\Sub_kategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    public function sub_kategori()
    {
        return $this->belongsTo(Sub_kategori::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function riwayat_produk()
    {
        return $this->hasMany(Riwayat_produk::class);
    }

    public function image1()
    {
        if ($this->gambar_produk1 && file_exists(public_path('images/gambar_produk1/' . $this->gambar_produk1))) {
            return asset('images/gambar_produk1/' . $this->gambar_produk1);
        } else {
            return asset('images/no_image.jpg');
        }
    }

    public function image2()
    {
        if ($this->gambar_produk2 && file_exists(public_path('images/gambar_produk2/' . $this->gambar_produk2))) {
            return asset('images/gambar_produk2/' . $this->gambar_produk2);
        } else {
            return asset('images/no_image.jpg');
        }
    }

    public function image3()
    {
        if ($this->gambar_produk3 && file_exists(public_path('images/gambar_produk3/' . $this->gambar_produk3))) {
            return asset('images/gambar_produk3/' . $this->gambar_produk3);
        } else {
            return asset('images/no_image.jpg');
        }
    }

    // mengahupus image(image) di storage(penyimpanan) public
    public function deleteImage1()
    {
        if ($this->gambar_produk1 && file_exists(public_path('images/gambar_produk1/' . $this->gambar_produk1))) {
            return unlink(public_path('images/gambar_produk1/' . $this->gambar_produk1));
        }
    }

    public function deleteImage2()
    {

        if ($this->gambar_produk2 && file_exists(public_path('images/gambar_produk2/' . $this->gambar_produk2))) {
            return unlink(public_path('images/gambar_produk2/' . $this->gambar_produk2));
        }
    }

    public function deleteImage3()
    {
        if ($this->gambar_produk3 && file_exists(public_path('images/gambar_produk3/' . $this->gambar_produk3))) {
            return unlink(public_path('images/gambar_produk3/' . $this->gambar_produk3));
        }
    }

}
