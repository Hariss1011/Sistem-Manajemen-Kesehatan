<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MemeriksaPasienController extends Controller
{
    public function index(Request $request)
    {
        $query = DaftarPoli::with([
            'pasien',
            'jadwal.dokter',
            'periksa.detailPeriksa',
        ])
            ->whereHas('jadwal', function ($jadwal) {
                $jadwal->where('id_dokter', Auth::id());
            })
            ->whereDate('tanggal_kunjungan', '<=', today())
            ->orderByDesc('tanggal_kunjungan')
            ->orderBy('no_antrian');

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->whereHas('pasien', function ($pasien) use ($search) {
                $pasien->where('name', 'like', "%{$search}%")
                    ->orWhere('no_rm', 'like', "%{$search}%");
            });
        }

        $pendaftarans = $query
            ->paginate(10)
            ->withQueryString();

        return view('dokter.memeriksa.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        $pendaftaran = $this->pendaftaranMilikDokter($id);

        $periksa = DB::transaction(function () use ($pendaftaran) {
            return Periksa::firstOrCreate(
                ['id_daftar_poli' => $pendaftaran->id],
                [
                    'id_pasien' => $pendaftaran->id_pasien,
                    'id_dokter' => Auth::id(),
                    'tgl_periksa' => now(),
                    'catatan' => null,
                    'biaya_periksa' => 0,
                ]
            );
        });

        $periksa->load([
            'daftarPoli.pasien',
            'detailPeriksa.obat',
        ]);

        $obats = Obat::orderBy('nama_obat')->get();
        $selectedObatIds = $periksa->detailPeriksa
            ->pluck('id_obat')
            ->all();

        return view('dokter.memeriksa.show', compact(
            'periksa',
            'obats',
            'selectedObatIds'
        ));
    }

    public function edit($id)
    {
        $pendaftaran = $this->pendaftaranMilikDokter($id);

        $periksa = Periksa::where('id_daftar_poli', $pendaftaran->id)
            ->first();

        if (! $periksa) {
            return redirect()
                ->route('memeriksa.show', $pendaftaran->id)
                ->with('info', 'Silakan mulai pemeriksaan pasien terlebih dahulu.');
        }

        $periksa->load([
            'daftarPoli.pasien',
            'detailPeriksa.obat',
        ]);

        $obats = Obat::orderBy('nama_obat')->get();
        $selectedObatIds = $periksa->detailPeriksa
            ->pluck('id_obat')
            ->all();

        return view('dokter.memeriksa.edit', compact(
            'periksa',
            'obats',
            'selectedObatIds'
        ));
    }

    public function update(Request $request, $id)
    {
        $periksa = $this->periksaMilikDokter($id);

        $validated = $request->validate([
            'catatan' => ['required', 'string', 'max:5000'],
            'obat' => ['nullable', 'array'],
            'obat.*' => [
                'required',
                'integer',
                'distinct',
                'exists:obats,id',
            ],
        ]);

        DB::transaction(function () use ($periksa, $validated) {
            $obatIds = $validated['obat'] ?? [];

            $obats = Obat::whereIn('id', $obatIds)->get();

            if ($obats->count() !== count(array_unique($obatIds))) {
                throw ValidationException::withMessages([
                    'obat' => 'Sebagian obat yang dipilih tidak tersedia.',
                ]);
            }

            DetailPeriksa::where('id_periksa', $periksa->id)->delete();

            foreach ($obats as $obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat->id,
                ]);
            }

            $periksa->update([
                'tgl_periksa' => now(),
                'catatan' => $validated['catatan'],
                'biaya_periksa' => 100000 + (int) $obats->sum('harga'),
            ]);
        });

        return redirect()
            ->route('memeriksa.index')
            ->with('success', 'Data pemeriksaan berhasil disimpan.');
    }

    private function pendaftaranMilikDokter($id): DaftarPoli
    {
        return DaftarPoli::whereHas('jadwal', function ($query) {
            $query->where('id_dokter', Auth::id());
        })->findOrFail($id);
    }

    private function periksaMilikDokter($id): Periksa
    {
        return Periksa::whereKey($id)
            ->where('id_dokter', Auth::id())
            ->whereHas('daftarPoli.jadwal', function ($query) {
                $query->where('id_dokter', Auth::id());
            })
            ->firstOrFail();
    }
}
