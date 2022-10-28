<?php

namespace App\Models;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_kategori extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
