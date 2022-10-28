<?php

namespace App\Models;

use App\Models\Sub_kategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public function sub_kategori()
    {
        return $this->hasMany(Sub_kategori::class);
    }
}
