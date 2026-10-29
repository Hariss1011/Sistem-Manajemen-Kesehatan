<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_dokter')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('id_pasien')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('id_daftar_poli')
                ->unique()
                ->constrained('daftar_polis')
                ->restrictOnDelete();

            $table->dateTime('tgl_periksa');
            $table->text('catatan')->nullable();
            $table->unsignedInteger('biaya_periksa')->default(0);

            $table->timestamps();

            $table->index(['id_dokter', 'tgl_periksa']);
            $table->index(['id_pasien', 'tgl_periksa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periksas');
    }
};
