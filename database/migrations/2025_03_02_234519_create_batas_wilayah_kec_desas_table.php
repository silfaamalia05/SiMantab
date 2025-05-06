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
        Schema::create('batas_wilayah_kec_desas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batas_wilayah_kab_kota_id');
            $table->string('KDCPUM');
            $table->string('WADMKC');
            $table->text('geojson_file');
            $table->string('style');
            $table->string('status');
            $table->timestamps();

            $table->foreign('batas_wilayah_kab_kota_id')->references('id')->on('batas_wilayah_kab_kotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batas_wilayah_kec_desas');
    }
};
