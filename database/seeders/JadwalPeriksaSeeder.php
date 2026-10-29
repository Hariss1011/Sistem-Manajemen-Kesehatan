<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            [
                'email' => 'andi.dokter@klinik.test',
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
            ],
            [
                'email' => 'siti.dokter@klinik.test',
                'hari' => 'Selasa',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '13:00:00',
            ],
            [
                'email' => 'budi.dokter@klinik.test',
                'hari' => 'Rabu',
                'jam_mulai' => '08:30:00',
                'jam_selesai' => '12:30:00',
            ],
        ];

        foreach ($jadwals as $data) {
            $dokter = User::where('email', $data['email'])
                ->where('role', User::ROLE_DOKTER)
                ->firstOrFail();

            JadwalPeriksa::updateOrCreate(
                [
                    'id_dokter' => $dokter->id,
                    'hari' => $data['hari'],
                    'jam_mulai' => $data['jam_mulai'],
                    'jam_selesai' => $data['jam_selesai'],
                ],
                ['status' => JadwalPeriksa::STATUS_AKTIF]
            );
        }
    }
}
