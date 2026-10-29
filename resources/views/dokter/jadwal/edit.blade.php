@extends('layouts.app')

@section('title', 'Ubah Status Jadwal')

@section('content')
    <style>
        .schedule-edit-page {
            color: #29372f;
            font-size: 14px;
        }

        .schedule-edit-page .page-heading {
            margin-bottom: 23px;
        }

        .schedule-edit-page .page-title {
            margin: 0 0 6px;
            color: #29372f;
            font-size: 26px;
            font-weight: 800;
        }

        .schedule-edit-page .page-description {
            margin: 0;
            color: #7b877e;
            font-size: 13px;
        }

        .schedule-edit-page .edit-panel {
            max-width: 850px;
            overflow: hidden;
            border: 1px solid #e6e9e1;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(41, 55, 47, .045);
        }

        .schedule-edit-page .panel-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 23px 26px;
            border-bottom: 1px solid #edf0ea;
            background: #fbfcf9;
        }

        .schedule-edit-page .header-icon {
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

        .schedule-edit-page .panel-title {
            margin: 0 0 5px;
            color: #29372f;
            font-size: 17px;
            font-weight: 750;
        }

        .schedule-edit-page .panel-subtitle {
            margin: 0;
            color: #7b877e;
            font-size: 12px;
            line-height: 1.6;
        }

        .schedule-edit-page .form-body {
            padding: 27px 26px;
        }

        .schedule-edit-page .field-group {
            margin-bottom: 23px;
        }

        .schedule-edit-page .field-label {
            display: block;
            margin-bottom: 9px;
            color: #37473c;
            font-size: 13px;
            font-weight: 750;
        }

        .schedule-edit-page .readonly-field {
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 48px;
            padding: 12px 14px;
            border: 1px solid #e6e9e1;
            border-radius: 10px;
            background: #f7f8f4;
            color: #37473c;
            font-size: 14px;
            font-weight: 650;
        }

        .schedule-edit-page .readonly-field i {
            width: 18px;
            color: #688f80;
            text-align: center;
        }

        .schedule-edit-page .field-hint {
            display: block;
            margin-top: 8px;
            color: #7b877e;
            font-size: 12px;
            line-height: 1.6;
        }

        .schedule-edit-page .status-option {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 13px;
            height: 100%;
            padding: 17px;
            border: 1px solid #dce3d9;
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: border-color .2s, background .2s, box-shadow .2s;
        }

        .schedule-edit-page .status-option:has(input:checked) {
            border-color: #688f80;
            background: #f1f5ef;
            box-shadow: 0 0 0 2px rgba(104, 143, 128, .1);
        }

        .schedule-edit-page .status-option input {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            margin-top: 3px;
            accent-color: #52796f;
            cursor: pointer;
        }

        .schedule-edit-page .status-option-title {
            display: block;
            margin-bottom: 5px;
            color: #29372f;
            font-size: 13px;
            font-weight: 750;
        }

        .schedule-edit-page .status-option-description {
            display: block;
            color: #7b877e;
            font-size: 12px;
            line-height: 1.6;
        }

        .schedule-edit-page .status-symbol {
            display: flex;
            width: 37px;
            height: 37px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .schedule-edit-page .status-symbol.active {
            background: #e3f4e9;
            color: #28744f;
        }

        .schedule-edit-page .status-symbol.inactive {
            background: #eef0ed;
            color: #7b817b;
        }

        .schedule-edit-page .info-box {
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

        .schedule-edit-page .info-box i {
            margin-top: 3px;
            color: #52796f;
        }

        .schedule-edit-page .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            padding: 19px 26px;
            border-top: 1px solid #edf0ea;
            background: #fbfcf9;
        }

        .schedule-edit-page .btn-primary-custom,
        .schedule-edit-page .btn-secondary-custom {
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

        .schedule-edit-page .btn-primary-custom {
            border: 1px solid #3d6253;
            background: #3d6253;
            color: #fff;
        }

        .schedule-edit-page .btn-primary-custom:hover {
            border-color: #304b40;
            background: #304b40;
            color: #fff;
        }

        .schedule-edit-page .btn-secondary-custom {
            border: 1px solid #dce3d9;
            background: #fff;
            color: #536157;
        }

        .schedule-edit-page .btn-secondary-custom:hover {
            background: #f1f5ef;
            color: #304b40;
        }

        @media (max-width: 575.98px) {
            .schedule-edit-page .page-title {
                font-size: 23px;
            }

            .schedule-edit-page .panel-header,
            .schedule-edit-page .form-body {
                padding: 20px;
            }

            .schedule-edit-page .form-footer {
                padding: 17px 20px;
            }

            .schedule-edit-page .form-footer a,
            .schedule-edit-page .form-footer button {
                flex: 1;
            }
        }
    </style>

    <div class="schedule-edit-page">
        <div class="page-heading">
            <h1 class="page-title">Ubah Status Jadwal</h1>
            <p class="page-description">
                Aktifkan atau nonaktifkan jadwal praktik Anda.
            </p>
        </div>

        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="edit-panel">
                <div class="panel-header">
                    <div class="header-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <h2 class="panel-title">Detail Jadwal Praktik</h2>
                        <p class="panel-subtitle">
                            Hari dan jam praktik ditampilkan sebagai informasi.
                            Anda dapat mengubah status jadwal di bawah.
                        </p>
                    </div>
                </div>

                <div class="form-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="field-group">
                                <label class="field-label">Hari Praktik</label>
                                <div class="readonly-field">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $jadwal->hari }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="field-group">
                                <label class="field-label">Jam Mulai</label>
                                <div class="readonly-field">
                                    <i class="far fa-clock"></i>
                                    {{ \Illuminate\Support\Str::of($jadwal->jam_mulai)->limit(5, '') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="field-group">
                                <label class="field-label">Jam Selesai</label>
                                <div class="readonly-field">
                                    <i class="far fa-clock"></i>
                                    {{ \Illuminate\Support\Str::of($jadwal->jam_selesai)->limit(5, '') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field-group mb-4">
                        <label class="field-label">Status Jadwal</label>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <label class="status-option">
                                    <input type="radio" name="status" value="Aktif"
                                        {{ old('status', $jadwal->status) === 'Aktif' ? 'checked' : '' }} required>
                                    <span class="status-symbol active">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                    <span>
                                        <span class="status-option-title">Aktif</span>
                                        <span class="status-option-description">
                                            Jadwal ditandai aktif sesuai mekanisme pendaftaran pasien.
                                        </span>
                                    </span>
                                </label>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="status-option">
                                    <input type="radio" name="status" value="Tidak Aktif"
                                        {{ old('status', $jadwal->status) === 'Tidak Aktif' ? 'checked' : '' }} required>
                                    <span class="status-symbol inactive">
                                        <i class="fas fa-pause-circle"></i>
                                    </span>
                                    <span>
                                        <span class="status-option-title">Tidak Aktif</span>
                                        <span class="status-option-description">
                                            Jadwal ditandai tidak aktif sesuai mekanisme sistem.
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        @error('status')
                            <div class="text-danger mt-2" style="font-size:12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <strong>Perlu diketahui:</strong>
                            perubahan status dapat memengaruhi ketersediaan jadwal
                            untuk pendaftaran pasien, sesuai aturan yang diterapkan sistem.
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
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
