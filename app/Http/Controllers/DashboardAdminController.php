<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Poli;
use App\Models\Periksa;
use App\Models\User;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Statistik data utama
        $jumlahDokter = User::dokter()->count();
        $jumlahPasien = User::pasien()->count();
        $jumlahPoli = Poli::count();
        $jumlahObat = Obat::count();

        // Statistik aktivitas hari ini
        $jumlahPendaftaranHariIni = DaftarPoli::whereDate(
            'tanggal_kunjungan',
            today()
        )->count();

        $jumlahPemeriksaanHariIni = Periksa::whereDate(
            'tgl_periksa',
            today()
        )->count();

        // Pendaftaran yang belum memiliki data pemeriksaan
        $jumlahBelumDiperiksa = DaftarPoli::whereDoesntHave(
            'periksa'
        )->count();

        // Lima pendaftaran terbaru
        $pendaftaranTerbaru = DaftarPoli::with([
            'pasien',
            'jadwal.dokter',
            'periksa',
        ])
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'jumlahDokter',
            'jumlahPasien',
            'jumlahPoli',
            'jumlahObat',
            'jumlahPendaftaranHariIni',
            'jumlahPemeriksaanHariIni',
            'jumlahBelumDiperiksa',
            'pendaftaranTerbaru'
        ));
    }
}
