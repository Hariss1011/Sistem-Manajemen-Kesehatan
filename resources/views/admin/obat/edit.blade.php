@extends('layouts.app')

@section('title', 'Edit Obat')

@section('content_header_title', 'Manajemen Obat')
@section('content_header_subtitle', 'Edit Obat')

@section('content_body')
    <div class="container-fluid px-0">

        <div class="mb-4">
            <div class="text-uppercase font-weight-bold mb-2" style="font-size: 11px; letter-spacing: 1.5px; color: #688f80;">
                Administrasi Klinik
            </div>
            <h2 class="font-weight-bold mb-1" style="color: #304b40; font-size: 28px;">
                Edit Informasi Obat
            </h2>
            <p class="mb-0" style="color: #7b877e; font-size: 14px;">
                Perbarui nama, kemasan, dan harga obat yang sudah terdaftar.
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                <div class="font-weight-bold mb-1">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Periksa kembali isian Anda.
                </div>
                <ul class="mb-0 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm"
                    style="border-radius: 13px; border: 1px solid #e6e9e1 !important; overflow: hidden;">

                    <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center mr-3"
                                style="width: 46px; height: 46px; border-radius: 12px; background: #e2f0e9; color: #3d7965;">
                                <i class="fas fa-edit fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mb-1" style="color: #304b40;">
                                    {{ $obat->nama_obat }}
                                </h5>
                                <p class="mb-0" style="font-size: 13px; color: #7b877e;">
                                    Perbarui informasi obat di bawah ini.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">
                        <form action="{{ route('admin.obat.update', $obat->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="nama_obat" class="font-weight-bold mb-2"
                                    style="color: #304b40; font-size: 14px;">
                                    Nama Obat <span style="color: #c65d50;">*</span>
                                </label>
                                <input type="text" id="nama_obat" name="nama_obat"
                                    class="form-control @error('nama_obat') is-invalid @enderror"
                                    value="{{ old('nama_obat', $obat->nama_obat) }}" maxlength="255" required
                                    style="height: 46px; border-radius: 9px; border-color: #dce4da; padding: 10px 14px;">

                                @error('nama_obat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kemasan" class="font-weight-bold mb-2"
                                    style="color: #304b40; font-size: 14px;">
                                    Kemasan <span style="color: #c65d50;">*</span>
                                </label>
                                <input type="text" id="kemasan" name="kemasan"
                                    class="form-control @error('kemasan') is-invalid @enderror"
                                    value="{{ old('kemasan', $obat->kemasan) }}" maxlength="100" required
                                    style="height: 46px; border-radius: 9px; border-color: #dce4da; padding: 10px 14px;">

                                @error('kemasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="harga" class="font-weight-bold mb-2"
                                    style="color: #304b40; font-size: 14px;">
                                    Harga (Rp) <span style="color: #c65d50;">*</span>
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold"
                                            style="border-color: #dce4da; background: #f7f7f1; color: #526257; border-radius: 9px 0 0 9px;">
                                            Rp
                                        </span>
                                    </div>
                                    <input type="number" id="harga" name="harga"
                                        class="form-control @error('harga') is-invalid @enderror"
                                        value="{{ old('harga', $obat->harga) }}" min="0" step="1" required
                                        style="height: 46px; border-color: #dce4da; padding: 10px 14px;">
                                </div>

                                @error('harga')
                                    <div class="text-danger mt-1" style="font-size: 12px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex flex-column flex-sm-row justify-content-end pt-3"
                                style="border-top: 1px solid #edf0e9; gap: 10px;">
                                <a href="{{ route('admin.obat.index') }}" class="btn px-4 py-2"
                                    style="background: #f0f2ec; color: #526257; border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-arrow-left mr-2"></i> Batal
                                </a>
                                <button type="submit" class="btn px-4 py-2"
                                    style="background: #3d6253; color: #fff; border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xl-5 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm" style="border-radius: 13px; border: 1px solid #e6e9e1 !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle mr-2" style="color: #688f80;"></i>
                            <h6 class="font-weight-bold mb-0" style="color: #304b40;">
                                Informasi Obat Saat Ini
                            </h6>
                        </div>

                        <div class="p-3 mb-3" style="background: #f7f7f1; border-radius: 9px;">
                            <div class="mb-1"
                                style="font-size: 11px; text-transform: uppercase; letter-spacing: .7px; color: #7b877e;">
                                Nama obat
                            </div>
                            <div class="font-weight-bold" style="font-size: 15px; color: #304b40;">
                                {{ $obat->nama_obat }}
                            </div>
                        </div>

                        <div class="p-3 mb-3" style="background: #f7f7f1; border-radius: 9px;">
                            <div class="mb-1"
                                style="font-size: 11px; text-transform: uppercase; letter-spacing: .7px; color: #7b877e;">
                                Kemasan
                            </div>
                            <div class="font-weight-bold" style="font-size: 14px; color: #304b40;">
                                {{ $obat->kemasan }}
                            </div>
                        </div>

                        <div class="p-3" style="background: #e8efe7; border-radius: 9px;">
                            <div class="mb-1"
                                style="font-size: 11px; text-transform: uppercase; letter-spacing: .7px; color: #526257;">
                                Harga saat ini
                            </div>
                            <div class="font-weight-bold" style="font-size: 22px; color: #304b40;">
                                Rp {{ number_format($obat->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <p class="mt-3 mb-0" style="font-size: 12px; color: #7b877e; line-height: 1.7;">
                            <i class="fas fa-shield-alt mr-1" style="color: #688f80;"></i>
                            Pastikan harga yang dimasukkan sesuai dengan satuan kemasan obat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
