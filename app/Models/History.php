<?php

namespace App\Models;

use App\Models\History;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
