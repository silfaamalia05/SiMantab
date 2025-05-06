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
        Schema::create('infrastrukturs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_infrastruktur');
            $table->string('nama_infrastruktur');
            $table->string('style');
            $table->text('geojson_file');
            $table->text('properties_show');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infrastrukturs');
    }
};
