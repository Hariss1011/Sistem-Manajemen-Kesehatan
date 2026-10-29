<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Poli;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $pasien = Auth::user();

        $no_rm = $pasien->no_rm;

        $polis = Poli::orderBy('nama_poli')->get();

        $jadwals = JadwalPeriksa::with('dokter.poli')
            ->where('status', JadwalPeriksa::STATUS_AKTIF)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        $riwayats = DaftarPoli::with([
            'jadwal.dokter.poli',
            'periksa.detailPeriksa.obat',
        ])
            ->where('id_pasien', $pasien->id)
            ->orderByDesc('tanggal_kunjungan')
            ->orderByDesc('id')
            ->get();

        return view('pasien.poli.index', compact(
            'no_rm',
            'polis',
            'jadwals',
            'riwayats'
        ));
    }


    public function detail($id)
    {
        $pendaftaran = DaftarPoli::with([
            'pasien',
            'jadwal.dokter.poli',
            'periksa.dokter',
            'periksa.detailPeriksa.obat',
        ])
            ->where('id_pasien', Auth::id())
            ->findOrFail($id);

        $jadwal = $pendaftaran->jadwal;
        $dokter = $jadwal?->dokter;
        $periksa = $pendaftaran->periksa;

        return response()->json([
            'pendaftaran' => [
                'id' => $pendaftaran->id,
                'nama_pasien' => $pendaftaran->pasien?->name ?? '-',
                'no_antrian' => $pendaftaran->no_antrian,
                'tanggal_kunjungan' => $pendaftaran->tanggal_kunjungan
                    ? Carbon::parse($pendaftaran->tanggal_kunjungan)->format('d-m-Y')
                    : '-',
                'keluhan' => $pendaftaran->keluhan ?: '-',
                'nama_poli' => $dokter?->poli?->nama_poli ?? '-',
                'nama_dokter' => $dokter?->name ?? '-',
                'hari' => $jadwal?->hari ?? '-',
                'jam_mulai' => $jadwal?->jam_mulai ?? '-',
                'jam_selesai' => $jadwal?->jam_selesai ?? '-',
                'pemeriksaan' => $periksa ? [
                    'tanggal' => $periksa->tgl_periksa
                        ? $periksa->tgl_periksa->format('d-m-Y H:i')
                        : '-',
                    'catatan' => $periksa->catatan ?: 'Belum ada catatan dokter.',
                    'biaya' => $periksa->biaya_periksa,
                    'obat' => $periksa->detailPeriksa->map(function ($detail) {
                        return $detail->obat?->nama_obat
                            ?? $detail->obat?->nama
                            ?? 'Obat tidak tersedia';
                    })->values(),
                ] : null,
            ],
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_poli' => ['required', 'integer', 'exists:polis,id'],
            'id_jadwal' => ['required', 'integer', 'exists:jadwal_periksas,id'],
            'keluhan' => ['required', 'string', 'max:1000'],
        ]);

        $pendaftaran = DB::transaction(function () use ($validated) {
            // Mengunci jadwal saat menentukan tanggal dan nomor antrean.
            $jadwal = JadwalPeriksa::whereKey($validated['id_jadwal'])
                ->where('status', JadwalPeriksa::STATUS_AKTIF)
                ->lockForUpdate()
                ->firstOrFail();

            $dokter = User::whereKey($jadwal->id_dokter)
                ->where('role', User::ROLE_DOKTER)
                ->firstOrFail();

            if ((int) $dokter->id_poli !== (int) $validated['id_poli']) {
                throw ValidationException::withMessages([
                    'id_jadwal' => 'Jadwal yang dipilih tidak sesuai dengan poli.',
                ]);
            }

            $tanggalKunjungan = $this->tanggalKunjunganBerikutnya($jadwal);

            $sudahTerdaftar = DaftarPoli::where('id_pasien', Auth::id())
                ->where('id_jadwal', $jadwal->id)
                ->whereDate('tanggal_kunjungan', $tanggalKunjungan)
                ->exists();

            if ($sudahTerdaftar) {
                throw ValidationException::withMessages([
                    'id_jadwal' => 'Anda sudah terdaftar pada jadwal tersebut untuk tanggal kunjungan ini.',
                ]);
            }

            $nomorAntrian = DaftarPoli::where('id_jadwal', $jadwal->id)
                ->whereDate('tanggal_kunjungan', $tanggalKunjungan)
                ->lockForUpdate()
                ->count() + 1;

            return DaftarPoli::create([
                'id_pasien' => Auth::id(),
                'id_jadwal' => $jadwal->id,
                'tanggal_kunjungan' => $tanggalKunjungan,
                'keluhan' => $validated['keluhan'],
                'no_antrian' => $nomorAntrian,
            ]);
        });

        return redirect()
            ->route('poli.index')
            ->with(
                'success',
                'Pendaftaran berhasil. Tanggal kunjungan: '
                    . Carbon::parse($pendaftaran->tanggal_kunjungan)->format('d-m-Y')
                    . ', nomor antrean: '
                    . $pendaftaran->no_antrian
                    . '.'
            );
    }

    public function destroy($id)
    {
        $pendaftaran = DaftarPoli::where('id_pasien', Auth::id())
            ->findOrFail($id);

        if ($pendaftaran->periksa()->exists()) {
            $periksa = $pendaftaran->periksa()
                ->with('detailPeriksa')
                ->first();

            if (
                $periksa
                && (
                    filled($periksa->catatan)
                    || $periksa->detailPeriksa->isNotEmpty()
                )
            ) {
                return redirect()
                    ->route('poli.index')
                    ->with(
                        'error',
                        'Pendaftaran tidak dapat dibatalkan karena pemeriksaan sudah dimulai atau memiliki catatan.'
                    );
            }

            // Bersihkan pemeriksaan kosong bila ada data lama yang belum lengkap.
            if ($periksa) {
                $periksa->delete();
            }
        }

        $pendaftaran->delete();

        return redirect()
            ->route('poli.index')
            ->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    public function getJadwalByPoli($id)
    {
        Poli::findOrFail($id);

        $jadwals = JadwalPeriksa::with([
            'dokter:id,name,id_poli,role',
        ])
            ->where('status', JadwalPeriksa::STATUS_AKTIF)
            ->whereHas('dokter', function ($query) use ($id) {
                $query->where('id_poli', $id)
                    ->where('role', User::ROLE_DOKTER);
            })
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return response()->json($jadwals);
    }

    /**
     * Menentukan jadwal terdekat yang belum melewati jam selesai.
     */
    private function tanggalKunjunganBerikutnya(
        JadwalPeriksa $jadwal
    ): string {
        $hariKeAngka = [
            'Minggu' => Carbon::SUNDAY,
            'Senin' => Carbon::MONDAY,
            'Selasa' => Carbon::TUESDAY,
            'Rabu' => Carbon::WEDNESDAY,
            'Kamis' => Carbon::THURSDAY,
            'Jumat' => Carbon::FRIDAY,
            'Sabtu' => Carbon::SATURDAY,
        ];

        $targetHari = $hariKeAngka[$jadwal->hari];
        $tanggal = Carbon::today();

        $selisihHari = (
            $targetHari - $tanggal->dayOfWeek + 7
        ) % 7;

        $tanggal->addDays($selisihHari);

        $sudahMelewatiJamSelesai = $tanggal->isToday()
            && now()->format('H:i:s') >= $jadwal->jam_selesai;

        if ($sudahMelewatiJamSelesai) {
            $tanggal->addDays(7);
        }

        return $tanggal->toDateString();
    }
}
