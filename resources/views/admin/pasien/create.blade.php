@extends('layouts.app')

@section('subtitle', 'Tambah Pasien')
@section('content_header_title', 'Manajemen Pasien')
@section('content_header_subtitle', 'Tambah Pasien')

@section('content_body')
    <div class="patient-form-page">

        <div class="patient-form-hero mb-4">
            <div class="patient-form-hero-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div>
                <div class="patient-form-eyebrow">MANAJEMEN DATA</div>
                <h2>Tambah Pasien Baru</h2>
                <p>Lengkapi informasi pasien untuk membuat data rekam medis baru.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert patient-validation-alert">
                <div class="font-weight-bold mb-2">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Periksa kembali data yang Anda masukkan.
                </div>
                <ul class="mb-0 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pasien.store') }}" method="POST">
            @csrf

            <div class="patient-form-card">
                <div class="patient-form-card-heading">
                    <div class="patient-form-section-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div>
                        <h5>Informasi Pribadi</h5>
                        <p>Masukkan identitas dasar pasien.</p>
                    </div>
                </div>

                <div class="patient-form-grid">
                    <div class="form-group">
                        <label for="name">Nama Lengkap <span class="required-mark">*</span></label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap pasien" autocomplete="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_ktp">Nomor KTP</label>
                        <input type="text" id="no_ktp" name="no_ktp"
                            class="form-control @error('no_ktp') is-invalid @enderror" value="{{ old('no_ktp') }}"
                            placeholder="Masukkan nomor KTP" inputmode="numeric">
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group patient-form-full">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Masukkan alamat lengkap pasien">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="patient-form-card">
                <div class="patient-form-card-heading">
                    <div class="patient-form-section-icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <div>
                        <h5>Informasi Kontak</h5>
                        <p>Informasi untuk menghubungi pasien.</p>
                    </div>
                </div>

                <div class="patient-form-grid">
                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" id="no_hp" name="no_hp"
                            class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}"
                            placeholder="Contoh: 081234567890" autocomplete="tel">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email <span class="required-mark">*</span></label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="nama@email.com" autocomplete="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="patient-form-card">
                <div class="patient-form-card-heading">
                    <div class="patient-form-section-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Akun Pasien</h5>
                        <p>Buat kata sandi untuk akses akun pasien.</p>
                    </div>
                </div>

                <div class="patient-form-grid">
                    <div class="form-group">
                        <label for="password">Kata Sandi <span class="required-mark">*</span></label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan kata sandi"
                            autocomplete="new-password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="patient-form-help">Gunakan kata sandi yang kuat dan tidak mudah ditebak.</small>
                    </div>

                    <div class="form-group">
                        <label>Nomor Rekam Medis</label>
                        <div class="patient-readonly-field">
                            <i class="fas fa-file-medical-alt mr-2"></i>
                            Dibuat otomatis oleh sistem
                        </div>
                        <small class="patient-form-help">Nomor rekam medis akan diisi oleh sistem saat pasien
                            disimpan.</small>
                    </div>
                </div>
            </div>

            <div class="patient-form-actions">
                <a href="{{ route('admin.pasien.index') }}" class="btn patient-btn-back">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="submit" class="btn patient-btn-save">
                    <i class="fas fa-save mr-2"></i> Simpan Pasien
                </button>
            </div>
        </form>
    </div>
@stop

@push('css')
    <style>
        .patient-form-page {
            color: #29372f;
            font-size: 14px;
        }

        .patient-form-hero {
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 24px 27px;
            background: linear-gradient(115deg, #e8efe7, #f7f7f1);
            border: 1px solid #dce6db;
            border-radius: 15px;
        }

        .patient-form-hero-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 55px;
            height: 55px;
            flex-shrink: 0;
            color: #3d6253;
            background: #fff;
            border-radius: 13px;
            font-size: 22px;
        }

        .patient-form-eyebrow {
            margin-bottom: 5px;
            color: #52796f;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .patient-form-hero h2 {
            margin: 0 0 6px;
            color: #253b33;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -.4px;
        }

        .patient-form-hero p {
            margin: 0;
            color: #59695f;
            font-size: 14px;
        }

        .patient-form-card {
            margin-bottom: 20px;
            padding: 24px;
            background: #fff;
            border: 1px solid #e1e7de;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(37, 59, 51, .035);
        }

        .patient-form-card-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 23px;
            padding-bottom: 18px;
            border-bottom: 1px solid #edf0e9;
        }

        .patient-form-section-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            color: #3d6253;
            background: #e8efe7;
            border-radius: 11px;
            font-size: 17px;
        }

        .patient-form-card-heading h5 {
            margin: 0 0 5px;
            color: #293f34;
            font-size: 16px;
            font-weight: 800;
        }

        .patient-form-card-heading p {
            margin: 0;
            color: #718076;
            font-size: 13px;
        }

        .patient-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0 22px;
        }

        .patient-form-grid .form-group {
            margin-bottom: 20px;
        }

        .patient-form-grid .form-group:last-child,
        .patient-form-full {
            margin-bottom: 0;
        }

        .patient-form-full {
            grid-column: 1 / -1;
        }

        .patient-form-page label {
            display: block;
            margin-bottom: 8px;
            color: #34483b;
            font-size: 13px;
            font-weight: 700;
        }

        .patient-form-page .form-control {
            min-height: 44px;
            padding: 10px 13px;
            color: #29372f;
            background: #fff;
            border: 1px solid #dce3d9;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: none;
        }

        .patient-form-page textarea.form-control {
            min-height: 90px;
            resize: vertical;
        }

        .patient-form-page .form-control:focus {
            border-color: #688f80;
            box-shadow: 0 0 0 3px rgba(104, 143, 128, .14);
        }

        .patient-form-page .form-control::placeholder {
            color: #9aa49b;
        }

        .required-mark {
            color: #b94c4c;
        }

        .patient-form-help {
            display: block;
            margin-top: 7px;
            color: #7b877e;
            font-size: 12px;
            line-height: 1.5;
        }

        .patient-readonly-field {
            display: flex;
            align-items: center;
            min-height: 44px;
            padding: 10px 13px;
            color: #647568;
            background: #f3f5f0;
            border: 1px dashed #d2dbcf;
            border-radius: 8px;
            font-size: 13px;
        }

        .patient-validation-alert {
            color: #873d3d;
            background: #fbefed;
            border: 1px solid #f1d8d3;
            border-radius: 10px;
        }

        .patient-validation-alert ul {
            line-height: 1.8;
        }

        .patient-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 17px 0 5px;
        }

        .patient-btn-back,
        .patient-btn-save {
            padding: 11px 17px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
        }

        .patient-btn-back {
            color: #526459;
            background: #fff;
            border: 1px solid #dce3d9;
        }

        .patient-btn-back:hover {
            color: #253b33;
            background: #f4f6f1;
        }

        .patient-btn-save {
            color: #fff;
            background: #3d6253;
            border: 1px solid #3d6253;
        }

        .patient-btn-save:hover {
            color: #fff;
            background: #253b33;
        }

        @media(max-width:767.98px) {
            .patient-form-hero {
                align-items: flex-start;
                padding: 20px;
            }

            .patient-form-hero h2 {
                font-size: 22px;
            }

            .patient-form-card {
                padding: 19px;
            }

            .patient-form-grid {
                grid-template-columns: 1fr;
            }

            .patient-form-full {
                grid-column: auto;
            }

            .patient-form-actions {
                flex-direction: column-reverse;
            }

            .patient-form-actions .btn {
                width: 100%;
            }
        }
    </style>
@endpush
