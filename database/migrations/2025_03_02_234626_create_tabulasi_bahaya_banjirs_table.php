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
        Schema::create('tabulasi_bahaya_banjirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batas_wilayah_kec_desa_id');
            $table->string('lb_rendah');
            $table->string('lb_sedang');
            $table->string('lb_tinggi');
            $table->string('kelas');
            $table->timestamps();

            $table->foreign('batas_wilayah_kec_desa_id')->references('id')->on('batas_wilayah_kec_desas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabulasi_bahaya_banjirs');
    }
};
