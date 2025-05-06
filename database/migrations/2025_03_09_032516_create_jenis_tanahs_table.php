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
        Schema::create('jenis_tanah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jenis_tanah');
            $table->string('nama_jenis_tanah');
            $table->text('geojson_file');
            $table->string('style');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_tanah');
    }
};
