<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kebuns', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengiriman');
            $table->string('nama_kebun');
            $table->string('afdeling');
            $table->string('nomor_blanko_pb25');
            $table->string('nopol_mobil');
            $table->string('nama_supir');
            $table->string('foto_keseluruhan_kebun')->nullable();
            $table->string('foto_sebelum_kebun')->nullable();
            $table->string('foto_sesudah_kebun')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebuns');
    }
};
