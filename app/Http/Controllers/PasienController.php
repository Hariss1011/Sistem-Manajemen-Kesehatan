<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = User::pasien()
            ->orderBy('name')
            ->paginate(10);

        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_ktp' => ['nullable', 'string', 'max:20', 'unique:users,no_ktp'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $pasien = DB::transaction(function () use ($validated) {
            return User::create([
                'name' => $validated['name'],
                'alamat' => $validated['alamat'] ?? null,
                'no_ktp' => $validated['no_ktp'] ?? null,
                'no_hp' => $validated['no_hp'] ?? null,
                'no_rm' => $this->generateNoRekamMedis(),
                'email' => $validated['email'],
                'role' => User::ROLE_PASIEN,
                'password' => $validated['password'],
            ]);
        });

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Pasien berhasil ditambahkan dengan nomor rekam medis ' . $pasien->no_rm . '.');
    }

    public function edit($id)
    {
        $pasien = User::pasien()->findOrFail($id);

        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = User::pasien()->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_ktp' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('users', 'no_ktp')->ignore($pasien->id),
            ],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'no_rm' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'no_rm')->ignore($pasien->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($pasien->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $data = [
            'name' => $validated['name'],
            'alamat' => $validated['alamat'] ?? null,
            'no_ktp' => $validated['no_ktp'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
            'no_rm' => $validated['no_rm'],
            'email' => $validated['email'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }

        $pasien->update($data);

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pasien = User::pasien()->findOrFail($id);

        if ($pasien->daftarPoliSebagaiPasien()->exists()) {
            return redirect()
                ->route('pasien.index')
                ->with(
                    'error',
                    'Pasien tidak dapat dihapus karena memiliki data pendaftaran.'
                );
        }

        if ($pasien->pemeriksaanSebagaiPasien()->exists()) {
            return redirect()
                ->route('pasien.index')
                ->with(
                    'error',
                    'Pasien tidak dapat dihapus karena memiliki riwayat pemeriksaan.'
                );
        }

        $pasien->delete();

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }

    /**
     * Membuat nomor rekam medis yang belum digunakan.
     */
    private function generateNoRekamMedis(): string
    {
        $prefix = 'RM' . now()->format('Ym');

        $nomorTerakhir = User::where('no_rm', 'like', $prefix . '%')
            ->orderByDesc('no_rm')
            ->value('no_rm');

        $nomorBerikutnya = $nomorTerakhir
            ? ((int) substr($nomorTerakhir, strlen($prefix))) + 1
            : 1;

        do {
            $noRm = $prefix . str_pad(
                (string) $nomorBerikutnya,
                4,
                '0',
                STR_PAD_LEFT
            );

            $sudahAda = User::where('no_rm', $noRm)->exists();
            $nomorBerikutnya++;
        } while ($sudahAda);

        return $noRm;
    }
}
