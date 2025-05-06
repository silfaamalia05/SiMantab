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
        Schema::create('batas_wilayah_kab_kotas', function (Blueprint $table) {
            $table->id();
            $table->string('KDPKAB');
            $table->string('WADMKK');
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
        Schema::dropIfExists('batas_wilayah_kab_kotas');
    }
};
