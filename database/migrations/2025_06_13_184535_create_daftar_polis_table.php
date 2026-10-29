<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_polis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pasien')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('id_jadwal')
                ->constrained('jadwal_periksas')
                ->restrictOnDelete();

            $table->date('tanggal_kunjungan');
            $table->text('keluhan');
            $table->unsignedInteger('no_antrian');

            $table->timestamps();

            $table->unique(
                ['id_pasien', 'id_jadwal', 'tanggal_kunjungan'],
                'pendaftaran_pasien_jadwal_tanggal_unique'
            );

            $table->unique(
                ['id_jadwal', 'tanggal_kunjungan', 'no_antrian'],
                'antrian_jadwal_tanggal_unique'
            );

            $table->index(['tanggal_kunjungan', 'id_jadwal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_polis');
    }
};
