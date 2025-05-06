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
        Schema::create('data_banjirs', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'kode_data');
            $table->string('nama_data');
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
        Schema::dropIfExists('data_banjirs');
    }
};
