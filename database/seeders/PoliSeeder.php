<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $polis = [
            [
                'nama_poli' => 'Poli Umum',
                'keterangan' => 'Pemeriksaan kesehatan umum dan keluhan dasar.',
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'keterangan' => 'Pemeriksaan dan perawatan kesehatan gigi.',
            ],
            [
                'nama_poli' => 'Poli Anak',
                'keterangan' => 'Pemeriksaan kesehatan bayi dan anak.',
            ],
        ];

        foreach ($polis as $data) {
            Poli::updateOrCreate(
                ['nama_poli' => $data['nama_poli']],
                ['keterangan' => $data['keterangan']]
            );
        }
    }
}
