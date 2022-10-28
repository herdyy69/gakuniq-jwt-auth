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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('kode_voucher');
            $table->integer('harga');
            $table->enum('label', ['gratis', 'berbayar'])->default('gratis');
            $table->integer('diskon')->default('0');
            $table->date('waktu_mulai');
            $table->date('waktu_berakhir');
            $table->enum('status', ['aktif', 'expired'])->default('aktif');
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
        Schema::dropIfExists('vouchers');
    }
};
