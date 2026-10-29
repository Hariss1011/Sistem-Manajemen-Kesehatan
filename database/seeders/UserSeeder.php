<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $poliUmum = Poli::where('nama_poli', 'Poli Umum')->firstOrFail();
        $poliGigi = Poli::where('nama_poli', 'Poli Gigi')->firstOrFail();
        $poliAnak = Poli::where('nama_poli', 'Poli Anak')->firstOrFail();

        $users = [
            [
                'name' => 'Administrator Klinik',
                'email' => 'admin@klinik.test',
                'role' => User::ROLE_ADMIN,
                'alamat' => 'Jl. Kesehatan No. 1',
                'no_hp' => '081200000001',
                'no_ktp' => null,
                'no_rm' => null,
                'id_poli' => null,
            ],
            [
                'name' => 'Dr. Andi Pratama',
                'email' => 'andi.dokter@klinik.test',
                'role' => User::ROLE_DOKTER,
                'alamat' => 'Jl. Melati No. 10',
                'no_hp' => '081200000002',
                'no_ktp' => null,
                'no_rm' => null,
                'id_poli' => $poliUmum->id,
            ],
            [
                'name' => 'Drg. Siti Rahma',
                'email' => 'siti.dokter@klinik.test',
                'role' => User::ROLE_DOKTER,
                'alamat' => 'Jl. Mawar No. 12',
                'no_hp' => '081200000003',
                'no_ktp' => null,
                'no_rm' => null,
                'id_poli' => $poliGigi->id,
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi.dokter@klinik.test',
                'role' => User::ROLE_DOKTER,
                'alamat' => 'Jl. Kenanga No. 8',
                'no_hp' => '081200000004',
                'no_ktp' => null,
                'no_rm' => null,
                'id_poli' => $poliAnak->id,
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.pasien@klinik.test',
                'role' => User::ROLE_PASIEN,
                'alamat' => 'Jl. Cempaka No. 2',
                'no_hp' => '081200000005',
                'no_ktp' => '3201000000000001',
                'no_rm' => 'RM-DEMO-0001',
                'id_poli' => null,
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.pasien@klinik.test',
                'role' => User::ROLE_PASIEN,
                'alamat' => 'Jl. Anggrek No. 3',
                'no_hp' => '081200000006',
                'no_ktp' => '3201000000000002',
                'no_rm' => 'RM-DEMO-0002',
                'id_poli' => null,
            ],
            [
                'name' => 'Rizky Maulana',
                'email' => 'rizky.pasien@klinik.test',
                'role' => User::ROLE_PASIEN,
                'alamat' => 'Jl. Dahlia No. 4',
                'no_hp' => '081200000007',
                'no_ktp' => '3201000000000003',
                'no_rm' => 'RM-DEMO-0003',
                'id_poli' => null,
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.pasien@klinik.test',
                'role' => User::ROLE_PASIEN,
                'alamat' => 'Jl. Flamboyan No. 5',
                'no_hp' => '081200000008',
                'no_ktp' => '3201000000000004',
                'no_rm' => 'RM-DEMO-0004',
                'id_poli' => null,
            ],
            [
                'name' => 'Fajar Hidayat',
                'email' => 'fajar.pasien@klinik.test',
                'role' => User::ROLE_PASIEN,
                'alamat' => 'Jl. Teratai No. 6',
                'no_hp' => '081200000009',
                'no_ktp' => '3201000000000005',
                'no_rm' => 'RM-DEMO-0005',
                'id_poli' => null,
            ],
            [
                'name' => 'Nadia Putri',
                'email' => 'nadia.pasien@klinik.test',
                'role' => User::ROLE_PASIEN,
                'alamat' => 'Jl. Bougenville No. 7',
                'no_hp' => '081200000010',
                'no_ktp' => '3201000000000006',
                'no_rm' => 'RM-DEMO-0006',
                'id_poli' => null,
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                array_merge($data, [
                    'password' => Hash::make('KlinikDemo123!'),
                ])
            );
        }
    }
}
