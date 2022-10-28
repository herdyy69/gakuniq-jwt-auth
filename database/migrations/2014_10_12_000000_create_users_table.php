<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('nomer_telepon')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->default('Laki-laki');
            $table->string('referensi');
            $table->enum('label_alamat', ['Rumah', 'Kantor'])->default('Rumah');
            $table->string('kota_kecamatan');
            $table->text('alamat_lengkap');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('saldo')->default('0');
            $table->integer('score')->default('0');
            $table->enum('role', ['costumer', 'admin'])->default('costumer');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
