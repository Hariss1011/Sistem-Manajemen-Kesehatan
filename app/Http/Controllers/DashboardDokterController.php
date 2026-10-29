<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardDokterController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();

        $pendaftaranDokter = DaftarPoli::whereHas(
            'jadwal',
            fn($query) => $query->where('id_dokter', $dokterId)
        );

        $totalPasien = (clone $pendaftaranDokter)
            ->distinct('id_pasien')
            ->count('id_pasien');

        $jumlahPendaftaran = (clone $pendaftaranDokter)->count();

        $sudahDiperiksa = Periksa::where('id_dokter', $dokterId)
            ->whereNotNull('catatan')
            ->count();

        $belumDiperiksa = max(
            0,
            $jumlahPendaftaran - $sudahDiperiksa
        );

        $pendaftaranHariIni = (clone $pendaftaranDokter)
            ->whereDate('tanggal_kunjungan', today())
            ->count();

        return view('dokter.dashboard', compact(
            'totalPasien',
            'sudahDiperiksa',
            'belumDiperiksa',
            'jumlahPendaftaran',
            'pendaftaranHariIni'
        ));
    }
}
