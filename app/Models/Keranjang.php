<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

}
