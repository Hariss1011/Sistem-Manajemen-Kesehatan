<?php

namespace Database\Seeders;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Database\Seeder;

class DetailPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $obatParacetamol = Obat::where(
            'nama_obat',
            'Paracetamol 500 mg'
        )->firstOrFail();

        $obatVitamin = Obat::where(
            'nama_obat',
            'Vitamin C 500 mg'
        )->firstOrFail();

        $obatAntasida = Obat::where(
            'nama_obat',
            'Antasida'
        )->firstOrFail();

        $periksas = Periksa::orderBy('id')->get();

        foreach ($periksas as $index => $periksa) {
            $obatPilihan = $index % 2 === 0
                ? [$obatParacetamol, $obatVitamin]
                : [$obatAntasida];

            foreach ($obatPilihan as $obat) {
                DetailPeriksa::firstOrCreate([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat->id,
                ]);
            }
        }
    }
}
