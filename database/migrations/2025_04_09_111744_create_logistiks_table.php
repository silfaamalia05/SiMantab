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
        Schema::create('logistik', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_alat');
            $table->string('merk');
            $table->string('model');
            $table->string('type');
            $table->string('kapasitas');
            $table->integer('jumlah');
            $table->string('kondisi_baik');
            $table->string('kondisi_rusak_ringan');
            $table->string('kondisi_rusak_berat');
            $table->string('lokasi');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistik');
    }
};
