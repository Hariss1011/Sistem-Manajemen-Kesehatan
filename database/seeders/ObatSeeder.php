<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $obats = [
            ['nama_obat' => 'Paracetamol 500 mg', 'kemasan' => 'Tablet', 'harga' => 2000],
            ['nama_obat' => 'Amoxicillin 500 mg', 'kemasan' => 'Kapsul', 'harga' => 3500],
            ['nama_obat' => 'Cetirizine 10 mg', 'kemasan' => 'Tablet', 'harga' => 2500],
            ['nama_obat' => 'Antasida', 'kemasan' => 'Tablet', 'harga' => 1500],
            ['nama_obat' => 'Vitamin C 500 mg', 'kemasan' => 'Tablet', 'harga' => 2000],
            ['nama_obat' => 'Ibuprofen 200 mg', 'kemasan' => 'Tablet', 'harga' => 2500],
            ['nama_obat' => 'Oralit', 'kemasan' => 'Sachet', 'harga' => 3000],
            ['nama_obat' => 'Salep Kulit', 'kemasan' => 'Tube', 'harga' => 12000],
        ];

        foreach ($obats as $data) {
            Obat::updateOrCreate(
                ['nama_obat' => $data['nama_obat']],
                [
                    'kemasan' => $data['kemasan'],
                    'harga' => $data['harga'],
                ]
            );
        }
    }
}
