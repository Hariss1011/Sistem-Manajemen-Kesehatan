<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Support\Facades\Auth;

class DashboardPasienController extends Controller
{
    public function index()
    {
        $pasienId = Auth::id();

        $jumlahPendaftaran = DaftarPoli::where('id_pasien', $pasienId)
            ->count();

        $jumlahJadwal = JadwalPeriksa::where(
            'status',
            JadwalPeriksa::STATUS_AKTIF
        )->count();

        $jumlahPoli = Poli::count();

        $pendaftaranAktif = DaftarPoli::where('id_pasien', $pasienId)
            ->whereDate('tanggal_kunjungan', '>=', today())
            ->count();

        return view('pasien.dashboard', compact(
            'jumlahPendaftaran',
            'jumlahJadwal',
            'jumlahPoli',
            'pendaftaranAktif'
        ));
    }
}
