<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DaftarPoliSeeder extends Seeder
{
    public function run(): void
    {
        $hariMap = [
            'Senin' => Carbon::MONDAY,
            'Selasa' => Carbon::TUESDAY,
            'Rabu' => Carbon::WEDNESDAY,
            'Kamis' => Carbon::THURSDAY,
            'Jumat' => Carbon::FRIDAY,
            'Sabtu' => Carbon::SATURDAY,
            'Minggu' => Carbon::SUNDAY,
        ];

        $keluhan = [
            'Demam dan sakit kepala.',
            'Batuk dan pilek selama beberapa hari.',
            'Sakit gigi saat mengunyah.',
            'Pemeriksaan kesehatan rutin.',
            'Nyeri perut sejak kemarin.',
            'Kontrol kesehatan anak.',
        ];

        $jadwals = JadwalPeriksa::with('dokter')->orderBy('id')->get();

        foreach ($jadwals as $index => $jadwal) {
            $hari = $hariMap[$jadwal->hari];

            $tanggalLalu = Carbon::now()
                ->previous($hari)
                ->toDateString();

            $tanggalMendatang = Carbon::now()
                ->next($hari)
                ->toDateString();

            $pasienPertama = User::pasien()
                ->where('email', 'ahmad.pasien@klinik.test')
                ->firstOrFail();

            $pasienKedua = User::pasien()
                ->where('email', 'siti.pasien@klinik.test')
                ->firstOrFail();

            $pendaftaran = [
                [
                    'id_pasien' => $pasienPertama->id,
                    'tanggal_kunjungan' => $tanggalLalu,
                    'keluhan' => $keluhan[$index],
                    'no_antrian' => 1,
                ],
                [
                    'id_pasien' => $pasienKedua->id,
                    'tanggal_kunjungan' => $tanggalLalu,
                    'keluhan' => $keluhan[($index + 1) % count($keluhan)],
                    'no_antrian' => 2,
                ],
                [
                    'id_pasien' => $pasienPertama->id,
                    'tanggal_kunjungan' => $tanggalMendatang,
                    'keluhan' => 'Pemeriksaan lanjutan.',
                    'no_antrian' => 1,
                ],
            ];

            foreach ($pendaftaran as $data) {
                DaftarPoli::updateOrCreate(
                    [
                        'id_pasien' => $data['id_pasien'],
                        'id_jadwal' => $jadwal->id,
                        'tanggal_kunjungan' => $data['tanggal_kunjungan'],
                    ],
                    [
                        'keluhan' => $data['keluhan'],
                        'no_antrian' => $data['no_antrian'],
                    ]
                );
            }
        }
    }
}
