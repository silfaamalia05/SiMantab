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
        Schema::table('logistik', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('kategori_logistik_id')->nullable();
            
            $table->foreign('kategori_logistik_id')->references('id')->on('kategori_logistik')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logistik', function (Blueprint $table) {
            //
            $table->dropColumn('kategori_logistik_id');
        });
    }
};
