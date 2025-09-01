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
        Schema::create('pks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengiriman');
            $table->string('nama_pks');
            $table->string('tujuan_pengiriman');
            $table->string('nomor_blanko_pb33');
            $table->string('nopol_mobil');
            $table->string('nama_supir');
            $table->string('foto_keseluruhan_pks')->nullable();
            $table->string('foto_sebelum_pks')->nullable();
            $table->string('foto_sesudah_pks')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pks');
    }
};
