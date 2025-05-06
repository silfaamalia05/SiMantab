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
        Schema::create('potensi_penduduk_terpapars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batas_wilayah_kec_desa_id');
            $table->string('penduduk_terpapar');
            $table->string('kelompok_umur_rentan');
            $table->string('penduduk_disabilitas');
            $table->string('penduduk_miskin');
            $table->timestamps();

            $table->foreign('batas_wilayah_kec_desa_id')->references('id')->on('batas_wilayah_kec_desas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potensi_penduduk_terpapars');
    }
};
