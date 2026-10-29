<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksas = Periksa::query()
            ->with([
                'dokter',
                'daftarPoli.jadwal',
                'detailPeriksa.obat',
            ])
            ->where('id_pasien', auth()->id())
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('pasien.periksa.index', compact('periksas'));
    }
}
