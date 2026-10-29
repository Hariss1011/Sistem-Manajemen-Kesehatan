<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_periksas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_dokter')
                ->constrained('users')
                ->restrictOnDelete();

            $table->enum('hari', [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu',
            ]);

            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('status', 20)->default('Tidak Aktif');

            $table->timestamps();

            $table->index(['hari', 'status']);
            $table->unique(
                ['id_dokter', 'hari', 'jam_mulai', 'jam_selesai'],
                'jadwal_dokter_waktu_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_periksas');
    }
};
