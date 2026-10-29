@csrf

<div class="mb-4">
    <label for="nama_poli" class="font-weight-bold mb-2" style="color: #304b40; font-size: 14px;">
        Nama Poli <span style="color: #c65d50;">*</span>
    </label>

    <input type="text" id="nama_poli" name="nama_poli" class="form-control @error('nama_poli') is-invalid @enderror"
        value="{{ old('nama_poli', $poli->nama_poli ?? '') }}" placeholder="Contoh: Poli Umum" maxlength="255" required
        style="height: 46px; border-radius: 9px; border-color: #dce4da; padding: 10px 14px;">

    @error('nama_poli')
        <div class="invalid-feedback">{{ $message }}</div>
    @else
        <small class="form-text mt-2" style="color: #7b877e;">
            Gunakan nama yang jelas dan mudah dikenali.
        </small>
    @enderror
</div>

<div class="mb-4">
    <label for="keterangan" class="font-weight-bold mb-2" style="color: #304b40; font-size: 14px;">
        Keterangan
    </label>

    <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
        rows="5" placeholder="Jelaskan jenis layanan atau informasi tambahan mengenai poli ini..."
        style="border-radius: 9px; border-color: #dce4da; padding: 12px 14px; resize: vertical;">{{ old('keterangan', $poli->keterangan ?? '') }}</textarea>

    @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
    @else
        <small class="form-text mt-2" style="color: #7b877e;">
            Opsional. Isi dengan informasi layanan jika diperlukan.
        </small>
    @enderror
</div>

<div class="d-flex flex-column flex-sm-row justify-content-end pt-3" style="border-top: 1px solid #edf0e9; gap: 10px;">
    <a href="{{ route('admin.poli.index') }}" class="btn px-4 py-2"
        style="background: #f0f2ec; color: #526257; border-radius: 8px; font-weight: 600;">
        <i class="fas fa-arrow-left mr-2"></i> Batal
    </a>

    <button type="submit" class="btn px-4 py-2"
        style="background: #3d6253; color: #fff; border-radius: 8px; font-weight: 600;">
        <i class="fas fa-save mr-2"></i>
        {{ isset($poli) && $poli->exists ? 'Simpan Perubahan' : 'Simpan Poli' }}
    </button>
</div>
