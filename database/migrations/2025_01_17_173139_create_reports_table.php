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
        Schema::create('reports', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('jenis_bencana');
            $table->string('waktu_kejadian');
            $table->string('lokasi');
            $table->string('koordinat');
            $table->string('sungai')->nullable();
            $table->integer('meninggal')->default(0);
            $table->integer('luka_berat')->default(0);
            $table->integer('luka_ringan')->default(0);
            $table->integer('hilang')->default(0);
            $table->integer('mengungsi')->default(0);
            $table->integer('rumah')->default(0);
            $table->integer('kantor')->default(0);
            $table->integer('fasum-faskes')->default(0);
            $table->integer('jalan-jembatan')->default(0);
            $table->integer('sawah-lahan-pertanian')->default(0);
            $table->string('pemukiman')->nullable();
            $table->string('perkotaan')->nullable();
            $table->string('kawasan-industri')->nullable();
            $table->string('sarana-prasarana')->nullable();
            $table->string('pertanian')->nullable();
            $table->string('lama-ancaman-bahaya')->nullable();
            $table->string('sarpras')->nullable();
            $table->string('tingkat_kerusakan')->nullable();
            $table->string('fungsi_layanan')->nullable(); // Status fungsi
            $table->string('ancaman')->nullable(); // Ancaman dan dampak
            $table->string('rencana_aksi')->nullable();
            $table->string('p_darurat')->nullable();
            $table->string('sda')->nullable();
            $table->string('kendala')->nullable();
            $table->string('kebutuhan')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
