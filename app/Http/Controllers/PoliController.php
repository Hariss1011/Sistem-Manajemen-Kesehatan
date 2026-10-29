<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::withCount('dokters')
            ->orderBy('nama_poli')
            ->paginate(10);

        return view('admin.poli.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.poli.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli' => [
                'required',
                'string',
                'max:100',
                'unique:polis,nama_poli',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        Poli::create($validated);

        return redirect()
            ->route('poli.index')
            ->with('success', 'Data poli berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);

        return view('admin.poli.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);

        $validated = $request->validate([
            'nama_poli' => [
                'required',
                'string',
                'max:100',
                Rule::unique('polis', 'nama_poli')->ignore($poli->id),
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $poli->update($validated);

        return redirect()
            ->route('poli.index')
            ->with('success', 'Data poli berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);

        if ($poli->dokters()->exists()) {
            return redirect()
                ->route('poli.index')
                ->with(
                    'error',
                    'Poli tidak dapat dihapus karena masih digunakan oleh dokter.'
                );
        }

        $poli->delete();

        return redirect()
            ->route('poli.index')
            ->with('success', 'Data poli berhasil dihapus.');
    }
}
