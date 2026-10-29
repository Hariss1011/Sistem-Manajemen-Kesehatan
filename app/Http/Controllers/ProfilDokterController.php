<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfilDokterController extends Controller
{
    public function edit()
    {
        $dokter = Auth::user();

        return view('dokter.profil.edit', compact('dokter'));
    }

    public function update(Request $request)
    {
        $dokter = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($dokter->id),
            ],
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
        ];

        if (! empty($validated['password'])) {
            // Password di-hash oleh cast pada model User.
            $data['password'] = $validated['password'];
        }

        $dokter->update($data);

        return redirect()
            ->route('profil.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
