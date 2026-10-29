@extends('layouts.app')

@section('title', 'Tambah Jadwal Periksa')

@section('content')
    <style>
        .schedule-form-page {
            color: #29372f;
            font-size: 14px;
        }

        .schedule-form-page .page-heading {
            margin-bottom: 23px;
        }

        .schedule-form-page .page-title {
            margin: 0 0 6px;
            color: #29372f;
            font-size: 26px;
            font-weight: 800;
        }

        .schedule-form-page .page-description {
            margin: 0;
            color: #7b877e;
            font-size: 13px;
        }

        .schedule-form-page .form-panel {
            max-width: 850px;
            overflow: hidden;
            border: 1px solid #e6e9e1;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(41, 55, 47, .045);
        }

        .schedule-form-page .panel-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 23px 26px;
            border-bottom: 1px solid #edf0ea;
            background: #fbfcf9;
        }

        .schedule-form-page .header-icon {
            display: flex;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #e8efe7;
            color: #3d6253;
            font-size: 20px;
        }

        .schedule-form-page .panel-title {
            margin: 0 0 5px;
            color: #29372f;
            font-size: 17px;
            font-weight: 750;
        }

        .schedule-form-page .panel-subtitle {
            margin: 0;
            color: #7b877e;
            font-size: 12px;
            line-height: 1.6;
        }

        .schedule-form-page .form-body {
            padding: 27px 26px;
        }

        .schedule-form-page .field-group {
            margin-bottom: 23px;
        }

        .schedule-form-page .field-label {
            display: block;
            margin-bottom: 9px;
            color: #37473c;
            font-size: 13px;
            font-weight: 750;
        }

        .schedule-form-page .required-mark {
            color: #bd5b4b;
        }

        .schedule-form-page .field-control {
            display: block;
            width: 100%;
            min-height: 45px;
            padding: 11px 13px;
            border: 1px solid #dce3d9;
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: #29372f;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s;
        }

        .schedule-form-page .field-control:focus {
            border-color: #688f80;
            box-shadow: 0 0 0 3px rgba(104, 143, 128, .15);
        }

        .schedule-form-page .field-control.is-invalid {
            border-color: #c45d52;
        }

        .schedule-form-page .field-hint {
            display: block;
            margin-top: 8px;
            color: #7b877e;
            font-size: 12px;
            line-height: 1.6;
        }

        .schedule-form-page .field-error {
            margin-top: 7px;
            color: #b7473e;
            font-size: 12px;
        }

        .schedule-form-page .info-box {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 15px 16px;
            border: 1px solid #dce7dc;
            border-radius: 11px;
            background: #f1f5ef;
            color: #536157;
            font-size: 12px;
            line-height: 1.7;
        }

        .schedule-form-page .info-box i {
            margin-top: 3px;
            color: #52796f;
        }

        .schedule-form-page .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            padding: 19px 26px;
            border-top: 1px solid #edf0ea;
            background: #fbfcf9;
        }

        .schedule-form-page .btn-primary-custom,
        .schedule-form-page .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 16px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 750;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, border-color .2s;
        }

        .schedule-form-page .btn-primary-custom {
            border: 1px solid #3d6253;
            background: #3d6253;
            color: #fff;
        }

        .schedule-form-page .btn-primary-custom:hover {
            border-color: #304b40;
            background: #304b40;
            color: #fff;
        }

        .schedule-form-page .btn-secondary-custom {
            border: 1px solid #dce3d9;
            background: #fff;
            color: #536157;
        }

        .schedule-form-page .btn-secondary-custom:hover {
            background: #f1f5ef;
            color: #304b40;
        }

        @media (max-width: 575.98px) {
            .schedule-form-page .page-title {
                font-size: 23px;
            }

            .schedule-form-page .panel-header,
            .schedule-form-page .form-body {
                padding: 20px;
            }

            .schedule-form-page .form-footer {
                padding: 17px 20px;
            }

            .schedule-form-page .form-footer a,
            .schedule-form-page .form-footer button {
                flex: 1;
            }
        }
    </style>

    <div class="schedule-form-page">
        <div class="page-heading">
            <h1 class="page-title">Tambah Jadwal Periksa</h1>
            <p class="page-description">
                Tentukan hari dan jam praktik yang ingin Anda tambahkan.
            </p>
        </div>

        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf

            <div class="form-panel">
                <div class="panel-header">
                    <div class="header-icon">
                        <i class="far fa-calendar-plus"></i>
                    </div>
                    <div>
                        <h2 class="panel-title">Informasi Jadwal Praktik</h2>
                        <p class="panel-subtitle">
                            Lengkapi hari dan waktu praktik dengan benar.
                            Kolom bertanda <span class="required-mark">*</span> wajib diisi.
                        </p>
                    </div>
                </div>

                <div class="form-body">
                    <div class="field-group">
                        <label for="hari" class="field-label">
                            Hari Praktik <span class="required-mark">*</span>
                        </label>

                        <select id="hari" name="hari" class="field-control @error('hari') is-invalid @enderror"
                            required>
                            <option value="">Pilih hari praktik</option>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}" {{ old('hari') === $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach
                        </select>

                        @error('hari')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                        <small class="field-hint">
                            Pilih hari ketika Anda tersedia untuk memberikan pelayanan.
                        </small>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="field-group">
                                <label for="jam_mulai" class="field-label">
                                    Jam Mulai <span class="required-mark">*</span>
                                </label>

                                <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                    class="field-control @error('jam_mulai') is-invalid @enderror" required>

                                @error('jam_mulai')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror

                                <small class="field-hint">
                                    Waktu dimulainya praktik.
                                </small>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="field-group">
                                <label for="jam_selesai" class="field-label">
                                    Jam Selesai <span class="required-mark">*</span>
                                </label>

                                <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}"
                                    class="field-control @error('jam_selesai') is-invalid @enderror" required>

                                @error('jam_selesai')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror

                                <small class="field-hint">
                                    Waktu berakhirnya praktik.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <strong>Perhatian:</strong>
                            pastikan jam selesai lebih lambat daripada jam mulai.
                            Sistem juga perlu memvalidasi agar tidak ada jadwal yang bertabrakan.
                        </div>
                    </div>
                </div>

                <div class="form-footer">
                    <a href="{{ route('jadwal.index') }}" class="btn-secondary-custom">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save"></i>
                        Simpan Jadwal
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
