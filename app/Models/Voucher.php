<?php

namespace App\Models;

use App\Models\Transaksi;
use App\Models\Voucher_user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function voucher_user()
    {
        return $this->hasMany(Voucher_user::class);
    }
}
