<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Keranjang;
use App\Models\TopUp;
use App\Models\Voucher_user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'nomer_telepon',
        'email',
        'username',
        'password',
        'tanggal_lahir',
        'jenis_kelamin',
        'referensi',
        'label_alamat',
        'kota_kecamatan',
        'alamat_lengkap',

    ];

    public function keranjang()
    {
        return $this->hasOne(Keranjang::class);
    }

    public function topup()
    {
        return $this->hasMany(TopUp::class);
    }

    public function voucher_user()
    {
        return $this->hasMany(Voucher_user::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
