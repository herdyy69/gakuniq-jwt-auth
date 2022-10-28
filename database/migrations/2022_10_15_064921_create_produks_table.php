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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_kategori_id');
            $table->foreign('sub_kategori_id')->references('id')->on('sub_kategoris')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('harga');
            $table->integer('stok');
            $table->integer('diskon')->default('0')->nullable();
            $table->text('deskripsi');
            $table->string('gambar_produk1');
            $table->string('gambar_produk2');
            $table->string('gambar_produk3');
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
        Schema::dropIfExists('produks');
    }
};
