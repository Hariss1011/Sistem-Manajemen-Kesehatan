<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::dokter()
            ->with('poli')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::orderBy('nama_poli')->get();

        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'id_poli' => ['required', 'integer', 'exists:polis,id'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'id_poli' => $validated['id_poli'],
            'role' => User::ROLE_DOKTER,
            'password' => $validated['password'],
        ]);

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = User::dokter()->findOrFail($id);
        $polis = Poli::orderBy('nama_poli')->get();

        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, $id)
    {
        $dokter = User::dokter()->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($dokter->id),
            ],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'id_poli' => ['required', 'integer', 'exists:polis,id'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'id_poli' => $validated['id_poli'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }

        $dokter->update($data);

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokter = User::dokter()->findOrFail($id);

        if ($dokter->jadwalPeriksa()->exists()) {
            return redirect()
                ->route('dokter.index')
                ->with(
                    'error',
                    'Dokter tidak dapat dihapus karena masih memiliki jadwal praktik.'
                );
        }

        if (
            $dokter->pemeriksaanSebagaiDokter()->exists()
        ) {
            return redirect()
                ->route('dokter.index')
                ->with(
                    'error',
                    'Dokter tidak dapat dihapus karena masih memiliki riwayat pemeriksaan.'
                );
        }

        $dokter->delete();

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Dokter berhasil dihapus.');
    }
}
