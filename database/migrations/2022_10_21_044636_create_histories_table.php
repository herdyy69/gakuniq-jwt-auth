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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('nama_pembeli');
            $table->string('nama_produk');
            $table->date('waktu_pemesanan');
            // $table->unsignedBigInteger('transaksi_id');
            // $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
            $table->enum('status', ['prosess', 'success', 'gagal'])->default('prosess');
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
        Schema::dropIfExists('histories');
    }
};
