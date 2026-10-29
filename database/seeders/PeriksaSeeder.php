<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = \App\Models\JadwalPeriksa::orderBy('id')->get();

        foreach ($jadwals as $jadwal) {
            $pendaftaran = DaftarPoli::where('id_jadwal', $jadwal->id)
                ->whereDate('tanggal_kunjungan', '<', now()->toDateString())
                ->orderBy('no_antrian')
                ->first();

            if (! $pendaftaran) {
                continue;
            }

            $waktuPeriksa = Carbon::parse(
                $pendaftaran->tanggal_kunjungan->toDateString()
                    . ' '
                    . $jadwal->jam_mulai
            );

            Periksa::updateOrCreate(
                ['id_daftar_poli' => $pendaftaran->id],
                [
                    'id_dokter' => $jadwal->id_dokter,
                    'id_pasien' => $pendaftaran->id_pasien,
                    'tgl_periksa' => $waktuPeriksa,
                    'catatan' => 'Pemeriksaan awal telah dilakukan. Data ini merupakan contoh untuk pengujian.',
                    'biaya_periksa' => 50000,
                ]
            );
        }
    }
}
