@extends('layouts.app')

@section('subtitle', 'Edit Dokter')
@section('content_header_title', 'Manajemen Dokter')
@section('content_header_subtitle', 'Edit Dokter')

@section('content_body')

    <div class="doctor-form-page">

        <div class="doctor-form-heading">
            <div class="doctor-form-heading-icon">
                <i class="fas fa-user-edit"></i>
            </div>

            <div>
                <div class="doctor-form-eyebrow">MANAJEMEN TENAGA MEDIS</div>
                <h2>Edit Data Dokter</h2>
                <p>Perbarui informasi dokter dan penempatan poli.</p>
            </div>
        </div>

        <div class="doctor-edit-profile">
            <div class="doctor-edit-avatar">
                {{ strtoupper(substr($dokter->name ?? 'D', 0, 1)) }}
            </div>

            <div class="doctor-edit-profile-info">
                <span>Dokter yang sedang diedit</span>
                <strong>{{ $dokter->name }}</strong>
                <small>{{ $dokter->email }}</small>
            </div>

            <span class="doctor-edit-id">ID #{{ $dokter->id }}</span>
        </div>

        @if ($errors->any())
            <div class="doctor-form-alert">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Periksa kembali data yang dimasukkan.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="doctor-form-card">

                <div class="doctor-form-card-heading">
                    <div class="doctor-form-section-icon">
                        <i class="fas fa-id-card"></i>
                    </div>

                    <div>
                        <h5>Informasi Dokter</h5>
                        <p>Perbarui identitas dan informasi kontak dokter.</p>
                    </div>
                </div>

                <div class="doctor-form-card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="doctor-field">
                                <label for="name">Nama Lengkap <span>*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name', $dokter->name) }}"
                                    class="form-control doctor-input @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap dokter" autocomplete="name" required>
                                @error('name')
                                    <small class="doctor-field-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="doctor-field">
                                <label for="email">Alamat Email <span>*</span></label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $dokter->email) }}"
                                    class="form-control doctor-input @error('email') is-invalid @enderror"
                                    placeholder="contoh@email.com" autocomplete="email" required>
                                @error('email')
                                    <small class="doctor-field-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="doctor-field">
                                <label for="no_hp">Nomor HP</label>
                                <input type="text" id="no_hp" name="no_hp"
                                    value="{{ old('no_hp', $dokter->no_hp) }}"
                                    class="form-control doctor-input @error('no_hp') is-invalid @enderror"
                                    placeholder="Contoh: 081234567890" autocomplete="tel">
                                @error('no_hp')
                                    <small class="doctor-field-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="doctor-field">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat"
                                    value="{{ old('alamat', $dokter->alamat) }}"
                                    class="form-control doctor-input @error('alamat') is-invalid @enderror"
                                    placeholder="Masukkan alamat dokter" autocomplete="street-address">
                                @error('alamat')
                                    <small class="doctor-field-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="doctor-form-card">

                <div class="doctor-form-card-heading">
                    <div class="doctor-form-section-icon">
                        <i class="fas fa-hospital"></i>
                    </div>

                    <div>
                        <h5>Akun dan Penempatan</h5>
                        <p>Atur password akun dan poli tempat dokter bertugas.</p>
                    </div>
                </div>

                <div class="doctor-form-card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="doctor-field">
                                <label for="password">Password Baru</label>
                                <input type="password" id="password" name="password"
                                    class="form-control doctor-input @error('password') is-invalid @enderror"
                                    placeholder="Kosongkan jika tidak diubah" autocomplete="new-password">
                                <small class="doctor-field-help">
                                    Password lama tetap digunakan jika kolom ini dikosongkan.
                                </small>
                                @error('password')
                                    <small class="doctor-field-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="doctor-field">
                                <label for="id_poli">Poli Penempatan <span>*</span></label>
                                <select id="id_poli" name="id_poli"
                                    class="form-control doctor-input @error('id_poli') is-invalid @enderror" required>
                                    <option value="">Pilih poli dokter</option>

                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}"
                                            {{ (string) old('id_poli', $dokter->id_poli) === (string) $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('id_poli')
                                    <small class="doctor-field-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="doctor-form-actions">
                <a href="{{ route('admin.dokter.index') }}" class="doctor-back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="doctor-save-btn">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

@stop

@push('css')
    <style>
        .doctor-form-page {
            max-width: 1000px;
            margin: 0 auto;
            color: #29372f;
            font-size: 14px;
        }

        .doctor-form-heading {
            display: flex;
            align-items: center;
            gap: 17px;
            margin-bottom: 23px;
        }

        .doctor-form-heading-icon {
            display: flex;
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border: 1px solid #d4e2d1;
            border-radius: 15px;
            background: #e8efe7;
            color: #304b40;
            font-size: 23px;
        }

        .doctor-form-eyebrow {
            margin-bottom: 6px;
            color: #52796f;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.1px;
        }

        .doctor-form-heading h2 {
            margin: 0 0 7px;
            color: #253b33;
            font-size: 27px;
            font-weight: 800;
        }

        .doctor-form-heading p {
            margin: 0;
            color: #657468;
            font-size: 13px;
            line-height: 1.6;
        }

        .doctor-edit-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 23px;
            padding: 17px 20px;
            border: 1px solid #dce6d9;
            border-radius: 12px;
            background: #f1f6ee;
        }

        .doctor-edit-avatar {
            display: flex;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: #304b40;
            color: #fff;
            font-size: 19px;
            font-weight: 800;
        }

        .doctor-edit-profile-info {
            min-width: 0;
        }

        .doctor-edit-profile-info span,
        .doctor-edit-profile-info strong,
        .doctor-edit-profile-info small {
            display: block;
        }

        .doctor-edit-profile-info span {
            margin-bottom: 4px;
            color: #657468;
            font-size: 11px;
        }

        .doctor-edit-profile-info strong {
            color: #304b40;
            font-size: 15px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .doctor-edit-profile-info small {
            margin-top: 4px;
            color: #718076;
            font-size: 12px;
            overflow-wrap: anywhere;
        }

        .doctor-edit-id {
            margin-left: auto;
            padding: 7px 10px;
            border: 1px solid #d5e2d1;
            border-radius: 7px;
            background: #fff;
            color: #52796f;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .doctor-form-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
            padding: 15px 17px;
            border: 1px solid #ebd0ca;
            border-radius: 10px;
            background: #fbefed;
            color: #8d453d;
            font-size: 13px;
        }

        .doctor-form-alert>i {
            margin-top: 2px;
            font-size: 17px;
        }

        .doctor-form-alert strong {
            display: block;
            margin-bottom: 6px;
        }

        .doctor-form-alert ul {
            margin: 0;
            padding-left: 18px;
            line-height: 1.7;
        }

        .doctor-form-card {
            overflow: hidden;
            margin-bottom: 20px;
            border: 1px solid #e0e7dd;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 4px 16px rgba(37, 59, 51, .035);
        }

        .doctor-form-card-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 21px 24px;
            border-bottom: 1px solid #e8ece5;
            background: #fbfcf9;
        }

        .doctor-form-section-icon {
            display: flex;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #e8efe7;
            color: #52796f;
            font-size: 16px;
        }

        .doctor-form-card-heading h5 {
            margin: 0 0 5px;
            color: #304b40;
            font-size: 16px;
            font-weight: 800;
        }

        .doctor-form-card-heading p {
            margin: 0;
            color: #718076;
            font-size: 12px;
            line-height: 1.5;
        }

        .doctor-form-card-body {
            padding: 25px 24px 8px;
        }

        .doctor-field {
            margin-bottom: 22px;
        }

        .doctor-field label {
            display: block;
            margin-bottom: 9px;
            color: #304b40;
            font-size: 13px;
            font-weight: 750;
        }

        .doctor-field label span {
            color: #b85c4f;
        }

        .doctor-input {
            height: 45px;
            padding: 10px 13px;
            border: 1px solid #dce4d9;
            border-radius: 8px;
            background-color: #fff;
            color: #29372f;
            font-size: 13px;
            box-shadow: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .doctor-input::placeholder {
            color: #9aa59a;
        }

        .doctor-input:focus {
            border-color: #789b84;
            box-shadow: 0 0 0 3px rgba(104, 143, 128, .13);
        }

        .doctor-input.is-invalid {
            border-color: #c86e62;
        }

        .doctor-field-help {
            display: block;
            margin-top: 8px;
            color: #788579;
            font-size: 11px;
            line-height: 1.6;
        }

        .doctor-field-error {
            display: block;
            margin-top: 7px;
            color: #ad4e43;
            font-size: 12px;
        }

        .doctor-form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 24px;
            padding: 18px 0 8px;
        }

        .doctor-back-btn,
        .doctor-save-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 44px;
            padding: 11px 18px;
            border: 1px solid transparent;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 750;
            transition: background .2s;
        }

        .doctor-back-btn {
            border-color: #dce4d9;
            background: #fff;
            color: #526257;
        }

        .doctor-back-btn:hover {
            background: #f1f5ee;
            color: #304b40;
            text-decoration: none;
        }

        .doctor-save-btn {
            border-color: #304b40;
            background: #304b40;
            color: #fff;
            cursor: pointer;
        }

        .doctor-save-btn:hover {
            background: #253b33;
            color: #fff;
        }

        @media (max-width: 575.98px) {
            .doctor-form-heading {
                align-items: flex-start;
            }

            .doctor-form-heading h2 {
                font-size: 23px;
            }

            .doctor-edit-profile {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .doctor-edit-id {
                margin-left: 63px;
            }

            .doctor-form-card-heading {
                padding: 18px;
            }

            .doctor-form-card-body {
                padding: 20px 18px 5px;
            }

            .doctor-form-actions {
                align-items: stretch;
                flex-direction: column-reverse;
            }

            .doctor-back-btn,
            .doctor-save-btn {
                width: 100%;
            }
        }
    </style>
@endpush
