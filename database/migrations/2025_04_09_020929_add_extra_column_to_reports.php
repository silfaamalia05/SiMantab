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
        Schema::table('reports', function (Blueprint $table) {
            //
            $table->string('status_laporan')->default('0');
            $table->string('estimasi_selesai')->default('');
            $table->text('keterangan_laporan');
            $table->bigInteger('users_id');
            $table->string('skala_prioritas');
            $table->string('logistik');
            $table->string('estimasi_anggaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
            $table->dropColumn('status_laporan');
            $table->dropColumn('estimasi_selesai');
            $table->dropColumn('keterangan_laporan');
            $table->dropColumn('users_id');
            $table->dropColumn('skala_prioritas');
            $table->dropColumn('logistik');
            $table->dropColumn('estimasi_anggaran');
        });
    }
};
