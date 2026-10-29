@extends('layouts.app')

@section('title', 'Periksa Pasien')
@section('content_header_title', 'Periksa Pasien')

@section('content_body')
    <style>
        .exam-form-page {
            color: #29372f;
        }

        .exam-form-page .form-panel {
            overflow: hidden;
            border: 1px solid #e6e9e1;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(37, 59, 51, .045);
        }

        .exam-form-page .panel-heading {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0e9;
        }

        .exam-form-page .panel-heading h5 {
            margin: 0;
            color: #304b40;
            font-size: 16px;
            font-weight: 750;
        }

        .exam-form-page .panel-heading p {
            margin: 5px 0 0;
            color: #7b877e;
            font-size: 12px;
        }

        .exam-form-page .panel-body {
            padding: 24px;
        }

        .exam-form-page .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            color: #304b40;
            font-size: 14px;
            font-weight: 750;
        }

        .exam-form-page .section-number {
            display: inline-flex;
            width: 30px;
            height: 30px;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #e8efe7;
            color: #52796f;
            font-size: 12px;
        }

        .exam-form-page .field-label {
            display: block;
            margin-bottom: 8px;
            color: #435148;
            font-size: 12px;
            font-weight: 700;
        }

        .exam-form-page .form-control {
            min-height: 43px;
            border: 1px solid #dfe5dc;
            border-radius: 10px;
            color: #29372f;
            font-size: 13px;
            box-shadow: none;
        }

        .exam-form-page .form-control:focus {
            border-color: #84a98c;
            box-shadow: 0 0 0 3px rgba(132, 169, 140, .15);
        }

        .exam-form-page textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .exam-form-page .readonly-field {
            display: flex;
            min-height: 43px;
            align-items: center;
            gap: 10px;
            padding: 10px 13px;
            border: 1px solid #e6e9e1;
            border-radius: 10px;
            background: #f7f7f1;
            color: #304b40;
            font-size: 13px;
            font-weight: 600;
        }

        .exam-form-page .readonly-field i {
            color: #688f80;
        }

        .exam-form-page .field-hint {
            margin-top: 7px;
            color: #879188;
            font-size: 11px;
            line-height: 1.6;
        }

        .exam-form-page .cost-panel {
            padding: 18px;
            border: 1px solid #dce7da;
            border-radius: 13px;
            background: #f7faf5;
        }

        .exam-form-page .cost-label {
            color: #68756c;
            font-size: 12px;
            font-weight: 600;
        }

        .exam-form-page .cost-value {
            margin-top: 5px;
            color: #304b40;
            font-size: 25px;
            font-weight: 800;
        }

        .exam-form-page .btn-exam-submit {
            display: inline-flex;
            min-height: 43px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            border: 0;
            border-radius: 10px;
            background: #52796f;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .exam-form-page .btn-exam-submit:hover {
            background: #3d6253;
            color: #fff;
        }

        .exam-form-page .btn-exam-back {
            display: inline-flex;
            min-height: 43px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: 1px solid #e0e5dd;
            border-radius: 10px;
            background: #fff;
            color: #526056;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .exam-form-page .btn-exam-back:hover {
            background: #f7f7f1;
            color: #304b40;
        }

        .exam-form-page .alert-validation {
            padding: 13px 16px;
            border: 1px solid #f1d0cd;
            border-radius: 10px;
            background: #fff5f4;
            color: #9c413a;
            font-size: 12px;
        }

        .exam-form-page .select2-container--default .select2-selection--multiple {
            min-height: 44px;
            padding: 4px 7px;
            border: 1px solid #dfe5dc;
            border-radius: 10px;
        }

        .exam-form-page .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #84a98c;
            box-shadow: 0 0 0 3px rgba(132, 169, 140, .15);
        }

        .exam-form-page .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border: 0;
            border-radius: 6px;
            background: #e8efe7;
            color: #304b40;
            font-size: 12px;
        }

        .exam-form-page .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #52796f;
        }

        .exam-form-page .select2-container {
            width: 100% !important;
        }

        @media (max-width: 767px) {
            .exam-form-page .panel-body {
                padding: 18px;
            }

            .exam-form-page .panel-heading {
                padding: 18px;
            }
        }
    </style>

    <div class="exam-form-page">
        <div class="mb-3">
            <h4 style="margin:0;color:#304b40;font-weight:750;">Pemeriksaan Baru</h4>
            <p style="margin:6px 0 0;color:#7b877e;font-size:13px;">
                Catat hasil pemeriksaan pasien dan tentukan obat yang diperlukan.
            </p>
        </div>

        @if ($errors->any())
            <div class="alert-validation mb-3">
                <div class="font-weight-bold mb-1">
                    <i class="fas fa-exclamation-circle mr-1"></i> Periksa kembali data yang dimasukkan.
                </div>
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('memeriksa.update', $periksa->id) }}" method="POST" id="formPemeriksaan">
            @csrf
            @method('PUT')

            <div class="form-panel mb-3">
                <div class="panel-heading">
                    <h5><i class="fas fa-user-circle mr-2" style="color:#688f80;"></i>Informasi Pasien</h5>
                    <p>Pastikan identitas pasien sesuai sebelum mengisi hasil pemeriksaan.</p>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="field-label">Nama Pasien</label>
                            <div class="readonly-field">
                                <i class="fas fa-user"></i>
                                {{ $periksa->daftarPoli->pasien->name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="field-label">Nomor Antrean</label>
                            <div class="readonly-field">
                                <i class="fas fa-ticket-alt"></i>
                                {{ $periksa->daftarPoli->no_antrian ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-0">
                            <label class="field-label">Tanggal Pemeriksaan</label>
                            <div class="readonly-field">
                                <i class="fas fa-calendar-alt"></i>
                                {{ now()->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-0">
                            <label class="field-label">Keluhan Pasien</label>
                            <div class="readonly-field">
                                <i class="fas fa-comment-medical"></i>
                                <span>{{ $periksa->daftarPoli->keluhan ?? 'Tidak ada keluhan tercatat.' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-panel">
                <div class="panel-heading">
                    <h5><i class="fas fa-notes-medical mr-2" style="color:#688f80;"></i>Hasil Pemeriksaan</h5>
                    <p>Isi catatan pemeriksaan dan pilih obat sesuai kebutuhan pasien.</p>
                </div>

                <div class="panel-body">
                    <div class="section-label">
                        <span class="section-number">01</span>
                        Catatan Dokter
                    </div>

                    <div class="form-group mb-4">
                        <label for="catatan" class="field-label">Catatan / Diagnosis</label>
                        <textarea id="catatan" name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="4"
                            placeholder="Tuliskan hasil pemeriksaan, diagnosis, atau rekomendasi...">{{ old('catatan', $periksa->catatan) }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="section-label">
                        <span class="section-number">02</span>
                        Resep Obat
                    </div>

                    <div class="form-group mb-4">
                        <label for="obat" class="field-label">Pilih Obat</label>
                        <select id="obat" name="obat[]" class="form-control @error('obat') is-invalid @enderror"
                            multiple>
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}"
                                    {{ in_array($obat->id, old('obat', $selectedObatIds ?? [])) ? 'selected' : '' }}>
                                    {{ $obat->nama_obat }} — Rp{{ number_format($obat->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <div class="field-hint">
                            Pilih satu atau beberapa obat. Gunakan pencarian untuk menemukan nama obat dengan cepat.
                        </div>
                        @error('obat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('obat.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="section-label">
                        <span class="section-number">03</span>
                        Ringkasan Biaya
                    </div>

                    <div class="cost-panel">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div class="mb-2 mb-md-0">
                                <div class="cost-label">Total biaya pemeriksaan</div>
                                <div style="margin-top:5px;color:#879188;font-size:11px;">
                                    Termasuk biaya pemeriksaan dasar Rp100.000 dan obat yang dipilih.
                                </div>
                            </div>

                            <div class="cost-value" id="totalFormatted">Rp100.000</div>
                        </div>

                        <input type="hidden" name="total" id="total" value="{{ old('total', 100000) }}">
                    </div>

                    <div class="d-flex justify-content-end flex-wrap mt-4" style="gap:10px;">
                        <a href="{{ route('memeriksa.index') }}" class="btn-exam-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn-exam-submit">
                            <i class="fas fa-save"></i> Simpan Pemeriksaan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            const selectObat = $('#obat');
            const totalField = $('#total');
            const totalFormatted = $('#totalFormatted');
            const biayaDasar = 100000;

            selectObat.select2({
                placeholder: 'Cari dan pilih obat...',
                allowClear: true,
                width: '100%'
            });

            function hitungTotal() {
                let total = biayaDasar;

                (selectObat.val() || []).forEach(function(id) {
                    const option = selectObat.find('option[value="' + id + '"]');
                    total += Number(option.data('harga')) || 0;
                });

                totalField.val(total);
                totalFormatted.text('Rp' + total.toLocaleString('id-ID'));
            }

            selectObat.on('change', hitungTotal);
            hitungTotal();
        });
    </script>
@endpush
