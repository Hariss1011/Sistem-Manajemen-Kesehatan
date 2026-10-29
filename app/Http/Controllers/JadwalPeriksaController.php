<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())
            ->orderByRaw(
                "FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')"
            )
            ->orderBy('jam_mulai')
            ->paginate(10);

        return view('dokter.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => [
                'required',
                Rule::in([
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu',
                ]),
            ],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],
        ]);

        $jadwalSama = JadwalPeriksa::where('id_dokter', Auth::id())
            ->where('hari', $validated['hari'])
            ->where('jam_mulai', $validated['jam_mulai'])
            ->where('jam_selesai', $validated['jam_selesai'])
            ->exists();

        if ($jadwalSama) {
            throw ValidationException::withMessages([
                'hari' => 'Jadwal dengan hari dan waktu tersebut sudah tersedia.',
            ]);
        }

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'status' => JadwalPeriksa::STATUS_TIDAK_AKTIF,
        ]);

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = $this->jadwalMilikDokter($id);

        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = $this->jadwalMilikDokter($id);

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    JadwalPeriksa::STATUS_AKTIF,
                    JadwalPeriksa::STATUS_TIDAK_AKTIF,
                ]),
            ],
        ]);

        DB::transaction(function () use ($jadwal, $validated) {
            if ($validated['status'] === JadwalPeriksa::STATUS_AKTIF) {
                JadwalPeriksa::where('id_dokter', Auth::id())
                    ->where('id', '!=', $jadwal->id)
                    ->update([
                        'status' => JadwalPeriksa::STATUS_TIDAK_AKTIF,
                    ]);
            }

            $jadwal->update([
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Status jadwal berhasil diperbarui.');
    }

    public function getJadwalByPoli($id)
    {
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

    private function jadwalMilikDokter($id): JadwalPeriksa
    {
        return JadwalPeriksa::where('id_dokter', Auth::id())
            ->findOrFail($id);
    }
}
