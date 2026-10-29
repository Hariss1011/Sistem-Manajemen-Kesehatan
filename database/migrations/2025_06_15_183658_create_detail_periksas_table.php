<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_periksas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_periksa')
                ->constrained('periksas')
                ->cascadeOnDelete();

            $table->foreignId('id_obat')
                ->constrained('obats')
                ->restrictOnDelete();

            $table->timestamps();

            $table->unique(
                ['id_periksa', 'id_obat'],
                'detail_periksa_obat_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_periksas');
    }
};
