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
        Schema::create('kawasan_pemukiman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kawasan_pemukiman');
            $table->string('nama_kawasan_pemukiman');
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
        Schema::dropIfExists('kawasan_pemukiman');
    }
};
