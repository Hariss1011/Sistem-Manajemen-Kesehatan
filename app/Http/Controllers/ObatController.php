<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::orderBy('nama_obat')
            ->paginate(10);

        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => [
                'required',
                'string',
                'max:100',
                'unique:obats,nama_obat',
            ],
            'kemasan' => [
                'required',
                'string',
                'max:50',
            ],
            'harga' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        Obat::create($validated);

        return redirect()
            ->route('obat.index')
            ->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);

        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate([
            'nama_obat' => [
                'required',
                'string',
                'max:100',
                Rule::unique('obats', 'nama_obat')->ignore($obat->id),
            ],
            'kemasan' => [
                'required',
                'string',
                'max:50',
            ],
            'harga' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $obat->update($validated);

        return redirect()
            ->route('obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);

        if ($obat->detailPeriksa()->exists()) {
            return redirect()
                ->route('obat.index')
                ->with(
                    'error',
                    'Obat tidak dapat dihapus karena sudah tercatat dalam riwayat pemeriksaan.'
                );
        }

        $obat->delete();

        return redirect()
            ->route('obat.index')
            ->with('success', 'Obat berhasil dihapus.');
    }
}
