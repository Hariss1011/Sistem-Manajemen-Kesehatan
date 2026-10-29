<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RiwayatPasienController extends Controller
{
    /**
     * Daftar pasien yang pernah mendaftar pada jadwal dokter login.
     */
    public function index()
    {
        $dokterId = Auth::id();

        $pasiens = User::pasien()
            ->whereHas('daftarPoliSebagaiPasien', function ($query) use ($dokterId) {
                $query->whereHas('jadwal', function ($jadwal) use ($dokterId) {
                    $jadwal->where('id_dokter', $dokterId);
                });
            })
            ->orderBy('name')
            ->get();

        return view('dokter.riwayat.index', compact('pasiens'));
    }

    /**
     * Mengambil riwayat pasien tertentu yang terkait dengan dokter login.
     */
    public function show($id)
    {
        $riwayats = Periksa::with([
            'daftarPoli.pasien',
            'daftarPoli.jadwal.dokter',
            'detailPeriksa.obat',
        ])
            ->where('id_dokter', Auth::id())
            ->whereHas('daftarPoli', function ($query) use ($id) {
                $query->where('id_pasien', $id)
                    ->whereHas('jadwal', function ($jadwal) {
                        $jadwal->where('id_dokter', Auth::id());
                    });
            })
            ->whereNotNull('catatan')
            ->orderByDesc('tgl_periksa')
            ->get();

        return response()->json([
            'riwayats' => $riwayats,
        ]);
    }

    /**
     * Detail pemeriksaan untuk pasien yang sedang login.
     */
    public function detail($id)
    {
        $periksa = Periksa::with([
            'daftarPoli.pasien',
            'daftarPoli.jadwal.dokter',
            'detailPeriksa.obat',
        ])
            ->where('id_pasien', Auth::id())
            ->whereNotNull('catatan')
            ->findOrFail($id);

        return response()->json([
            'periksa' => $periksa,
        ]);
    }
}
