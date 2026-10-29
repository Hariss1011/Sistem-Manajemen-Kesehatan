@extends('layouts.app')

@section('subtitle', 'Profil Dokter')

@section('content_body')
    <div class="doctor-profile-page">
        {{-- Header halaman --}}
        <div class="profile-heading">
            <div>
                <span class="section-eyebrow">PENGATURAN AKUN</span>
                <h2>Profil Dokter</h2>
                <p>Kelola informasi pribadi dan keamanan akun Anda.</p>
            </div>
            <div class="profile-heading-icon">
                <i class="fas fa-user-md"></i>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success custom-alert">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger custom-alert">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <div>
                    <strong>Periksa kembali data Anda.</strong>
                    <ul class="mb-0 mt-1 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="row">
            {{-- Ringkasan profil --}}
            <div class="col-lg-4 mb-4">
                <div class="profile-summary-card">
                    <div class="profile-cover"></div>

                    <div class="profile-summary-content">
                        <div class="profile-avatar">
                            <i class="fas fa-user-md"></i>
                        </div>

                        <span class="profile-role">TENAGA MEDIS</span>
                        <h4>{{ $dokter->name }}</h4>
                        <p class="profile-email">
                            <i class="far fa-envelope mr-1"></i>
                            {{ $dokter->email }}
                        </p>

                        <div class="profile-divider"></div>

                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <span>Alamat</span>
                                <p>{{ $dokter->alamat ?: 'Belum diisi' }}</p>
                            </div>
                        </div>

                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <span>Nomor Telepon</span>
                                <p>{{ $dokter->no_hp ?: 'Belum diisi' }}</p>
                            </div>
                        </div>

                        <div class="profile-note">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Pastikan informasi akun selalu diperbarui.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Formulir profil --}}
            <div class="col-lg-8 mb-4">
                <div class="profile-form-card">
                    <div class="form-card-heading">
                        <div class="form-heading-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div>
                            <h5>Informasi Pribadi</h5>
                            <p>Perbarui informasi yang terdaftar pada akun Anda.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('dokter.profil.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-section-title">
                            <i class="fas fa-id-card mr-2"></i>
                            Data Dasar
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Nama Lengkap <span class="required-mark">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $dokter->name) }}" placeholder="Masukkan nama lengkap"
                                        maxlength="255" required>
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="email">Alamat Email <span class="required-mark">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $dokter->email) }}" placeholder="nama@email.com"
                                        maxlength="255" required>
                                </div>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="alamat">Alamat</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <input type="text" name="alamat" id="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        value="{{ old('alamat', $dokter->alamat) }}" placeholder="Masukkan alamat">
                                </div>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="no_hp">Nomor Telepon</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-phone-alt"></i>
                                    <input type="text" name="no_hp" id="no_hp"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        value="{{ old('no_hp', $dokter->no_hp) }}" placeholder="Contoh: 081234567890">
                                </div>
                                @error('no_hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-section-title password-section-title">
                            <i class="fas fa-lock mr-2"></i>
                            Keamanan Akun
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <div class="input-with-icon password-input">
                                <i class="fas fa-key"></i>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password baru jika ingin menggantinya"
                                    autocomplete="new-password">
                                <button type="button" class="password-toggle" id="togglePassword"
                                    aria-label="Tampilkan password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <small class="form-hint">
                                Kosongkan jika tidak ingin mengubah password.
                            </small>
                            @error('password')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-footer">
                            <span class="form-footer-note">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pastikan data sudah benar.
                            </span>
                            <button type="submit" class="btn-save-profile">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
    <style>
        .doctor-profile-page {
            color: #29372f;
        }

        .profile-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .section-eyebrow {
            color: #688f80;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .profile-heading h2 {
            margin: 5px 0 6px;
            font-size: 27px;
            font-weight: 750;
            color: #253b33;
        }

        .profile-heading p,
        .form-card-heading p {
            margin: 0;
            color: #7b877e;
            font-size: 13px;
        }

        .profile-heading-icon {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            color: #52796f;
            background: #e8efe7;
            font-size: 23px;
        }

        .custom-alert {
            display: flex;
            align-items: flex-start;
            border: 0;
            border-radius: 12px;
            font-size: 13px;
        }

        .profile-summary-card,
        .profile-form-card {
            height: 100%;
            overflow: hidden;
            background: #fff;
            border: 1px solid #e6e9e1;
            border-radius: 17px;
            box-shadow: 0 5px 20px rgba(37, 59, 51, .045);
        }

        .profile-cover {
            height: 105px;
            background: linear-gradient(130deg, #304b40, #688f80);
            position: relative;
        }

        .profile-cover::after {
            content: "";
            position: absolute;
            width: 140px;
            height: 140px;
            right: -25px;
            top: -60px;
            border: 24px solid rgba(255, 255, 255, .08);
            border-radius: 50%;
        }

        .profile-summary-content {
            padding: 0 24px 24px;
        }

        .profile-avatar {
            width: 82px;
            height: 82px;
            margin-top: -41px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 5px solid #fff;
            border-radius: 23px;
            background: #e8efe7;
            color: #3d6253;
            font-size: 33px;
        }

        .profile-role {
            display: inline-block;
            margin-top: 17px;
            padding: 5px 9px;
            color: #52796f;
            background: #e8efe7;
            border-radius: 6px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .profile-summary-content h4 {
            margin: 12px 0 5px;
            font-size: 19px;
            font-weight: 750;
            overflow-wrap: anywhere;
        }

        .profile-email {
            color: #7b877e;
            font-size: 12px;
            overflow-wrap: anywhere;
        }

        .profile-divider {
            height: 1px;
            background: #edf0e9;
            margin: 22px 0;
        }

        .profile-info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 19px;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #52796f;
            background: #f0f4ee;
            border-radius: 10px;
        }

        .profile-info-item span {
            color: #7b877e;
            font-size: 11px;
        }

        .profile-info-item p {
            margin: 3px 0 0;
            font-size: 13px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .profile-note {
            margin-top: 25px;
            padding: 12px;
            border-radius: 10px;
            background: #f7f7f1;
            color: #688174;
            font-size: 11px;
            line-height: 1.6;
        }

        .profile-form-card {
            padding: 27px;
        }

        .form-card-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 23px;
            margin-bottom: 24px;
            border-bottom: 1px solid #edf0e9;
        }

        .form-heading-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            color: #52796f;
            background: #e8efe7;
            font-size: 18px;
        }

        .form-card-heading h5 {
            margin: 0 0 5px;
            color: #304b40;
            font-size: 16px;
            font-weight: 750;
        }

        .form-section-title {
            margin-bottom: 18px;
            color: #3d6253;
            font-size: 12px;
            font-weight: 800;
        }

        .password-section-title {
            padding-top: 22px;
            margin-top: 7px;
            border-top: 1px solid #edf0e9;
        }

        .profile-form-card label {
            margin-bottom: 8px;
            color: #445349;
            font-size: 12px;
            font-weight: 700;
        }

        .required-mark {
            color: #c45c51;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon>i {
            position: absolute;
            top: 13px;
            left: 13px;
            color: #8a9b8e;
            font-size: 13px;
            z-index: 2;
        }

        .input-with-icon .form-control {
            height: 43px;
            padding: 10px 13px 10px 38px;
            border: 1px solid #e2e8df;
            border-radius: 9px;
            background: #fcfdfb;
            color: #29372f;
            font-size: 12px;
            box-shadow: none;
        }

        .input-with-icon .form-control:focus {
            border-color: #84a98c;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(132, 169, 140, .14);
        }

        .password-input .form-control {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            top: 5px;
            right: 7px;
            width: 33px;
            height: 33px;
            border: 0;
            background: transparent;
            color: #7b877e;
            cursor: pointer;
        }

        .form-hint {
            display: block;
            margin-top: 7px;
            color: #7b877e;
            font-size: 11px;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            padding-top: 22px;
            margin-top: 15px;
            border-top: 1px solid #edf0e9;
        }

        .form-footer-note {
            color: #7b877e;
            font-size: 11px;
        }

        .btn-save-profile {
            padding: 11px 17px;
            border: 0;
            border-radius: 9px;
            background: #3d6253;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            transition: background .2s, transform .2s;
        }

        .btn-save-profile:hover {
            background: #304b40;
            color: #fff;
            transform: translateY(-1px);
        }

        @media (max-width: 576px) {
            .profile-heading h2 {
                font-size: 23px;
            }

            .profile-form-card {
                padding: 19px;
            }

            .form-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .btn-save-profile {
                width: 100%;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (toggleButton && passwordInput) {
                toggleButton.addEventListener('click', function() {
                    const isPassword = passwordInput.type === 'password';

                    passwordInput.type = isPassword ? 'text' : 'password';
                    toggleButton.innerHTML = isPassword ?
                        '<i class="far fa-eye-slash"></i>' :
                        '<i class="far fa-eye"></i>';

                    toggleButton.setAttribute(
                        'aria-label',
                        isPassword ? 'Sembunyikan password' : 'Tampilkan password'
                    );
                });
            }
        });
    </script>
@endpush
