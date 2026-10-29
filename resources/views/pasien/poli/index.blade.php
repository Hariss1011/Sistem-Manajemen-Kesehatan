    @extends('layouts.app')

    @section('title', 'Daftar Poli')
    @section('content_header_title', 'Daftar Poli')
    @section('subtitle', 'Pendaftaran kunjungan dan riwayat poli')

    @section('content_body')
        <div class="poli-page">

            {{-- Header --}}
            <div class="poli-hero">
                <div class="hero-copy">
                    <span class="hero-eyebrow">LAYANAN PASIEN</span>
                    <h2>Pendaftaran Poli</h2>
                    <p>Pilih poli dan jadwal dokter yang sesuai, lalu pantau status kunjungan Anda di sini.</p>
                    <div class="hero-actions">
                        <a href="{{ route('pasien.periksa.index') }}" class="hero-link">
                            <i class="fas fa-stethoscope mr-2"></i>Halaman Periksa
                        </a>
                    </div>
                </div>
                <div class="hero-icon">
                    <i class="fas fa-hospital-user"></i>
                </div>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success custom-alert">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger custom-alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger custom-alert">
                    <strong>Data pendaftaran belum valid.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                {{-- Form pendaftaran --}}
                <div class="col-xl-4 col-lg-5 mb-4">
                    <div class="form-card">
                        <div class="card-heading">
                            <div class="heading-icon">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div>
                                <h5>Daftar Kunjungan</h5>
                                <p>Lengkapi informasi berikut.</p>
                            </div>
                        </div>

                        <div class="step-indicator">
                            <div class="step-number">1</div>
                            <div>
                                <strong>Pilih Poli dan Dokter</strong>
                                <small>Tentukan layanan yang dibutuhkan.</small>
                            </div>
                        </div>

                        <form action="{{ route('pasien.poli.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="no_rm">Nomor Rekam Medis</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-id-card"></i>
                                    <input type="text" id="no_rm" class="form-control"
                                        value="{{ auth()->user()->no_rm ?? '-' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="id_poli">Poli Tujuan <span class="required">*</span></label>
                                <select name="id_poli" id="id_poli" class="form-control custom-select-field" required>
                                    <option value="">Pilih poli tujuan</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}"
                                            {{ old('id_poli') == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_poli')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="step-indicator step-second">
                                <div class="step-number">2</div>
                                <div>
                                    <strong>Pilih Jadwal</strong>
                                    <small>Jadwal akan menyesuaikan poli tujuan.</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jadwalSelect">Jadwal Dokter <span class="required">*</span></label>
                                <select name="id_jadwal" id="jadwalSelect" class="form-control custom-select-field"
                                    required>
                                    <option value="">Pilih poli terlebih dahulu</option>
                                </select>
                                @error('id_jadwal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small class="field-hint">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Pilihan jadwal tersedia setelah Anda memilih poli.
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="keluhan">Keluhan yang Dirasakan</label>
                                <textarea name="keluhan" id="keluhan" class="form-control custom-textarea" rows="4"
                                    placeholder="Jelaskan keluhan Anda secara singkat...">{{ old('keluhan') }}</textarea>
                                @error('keluhan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn-register">
                                <i class="fas fa-calendar-check mr-2"></i>Daftar Sekarang
                            </button>

                            <p class="form-footnote">
                                <i class="fas fa-shield-alt mr-1"></i>
                                Pastikan poli dan jadwal yang dipilih sudah sesuai.
                            </p>
                        </form>
                    </div>
                </div>

                {{-- Riwayat pendaftaran --}}
                <div class="col-xl-8 col-lg-7 mb-4">
                    <div class="history-panel">
                        <div class="history-panel-heading">
                            <div>
                                <div class="panel-title-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <h5>Riwayat Pendaftaran</h5>
                                <p>Daftar kunjungan poli yang pernah Anda buat.</p>
                            </div>
                            <span class="total-badge">
                                {{ $riwayats->count() }} kunjungan
                            </span>
                        </div>

                        @if ($riwayats->isEmpty())
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-calendar-times"></i>
                                </div>
                                <h6>Belum Ada Pendaftaran</h6>
                                <p>Setelah mendaftar, informasi kunjungan Anda akan tampil di bagian ini.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table poli-table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Poli dan Dokter</th>
                                            <th>Jadwal</th>
                                            <th>Antrian</th>
                                            <th>Status</th>
                                            <th class="text-center">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayats as $i => $item)
                                            @php
                                                $jadwal = $item->jadwal;
                                                $sudah =
                                                    $item->periksa &&
                                                    ($item->periksa->catatan || $item->periksa->detailPeriksa->count());
                                            @endphp
                                            <tr>
                                                <td class="row-number">{{ $i + 1 }}</td>
                                                <td>
                                                    <div class="poli-name">
                                                        <div class="poli-avatar">
                                                            <i class="fas fa-hospital"></i>
                                                        </div>
                                                        <div>
                                                            <strong>{{ $jadwal->dokter->poli->nama_poli ?? '-' }}</strong>
                                                            <small>{{ $jadwal->dokter->name ?? '-' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="schedule-info">
                                                        <strong>{{ $jadwal->hari ?? '-' }}</strong>
                                                        <small>
                                                            {{ $jadwal->jam_mulai ?? '--:--' }}–{{ $jadwal->jam_selesai ?? '--:--' }}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="queue-number">
                                                        {{ $item->no_antrian ?? '-' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($sudah)
                                                        <span class="status-pill status-done">
                                                            <i class="fas fa-check-circle mr-1"></i>Selesai
                                                        </span>
                                                    @else
                                                        <span class="status-pill status-waiting">
                                                            <i class="fas fa-clock mr-1"></i>Belum selesai
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn-detail js-detail-riwayat"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye mr-1"></i>Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="help-card">
                        <div class="help-icon"><i class="fas fa-lightbulb"></i></div>
                        <div>
                            <strong>Informasi pendaftaran</strong>
                            <p>Pilih poli terlebih dahulu untuk melihat jadwal dokter yang tersedia. Detail hasil
                                pemeriksaan
                                dapat dibuka jika data pemeriksaan sudah tercatat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal detail --}}
        <div class="modal fade" id="detailRiwayatModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content detail-modal">
                    <div class="modal-header detail-modal-header">
                        <div class="modal-title-wrap">
                            <div class="modal-title-icon"><i class="fas fa-file-medical-alt"></i></div>
                            <div>
                                <h5 class="modal-title">Detail Pendaftaran</h5>
                                <small>Informasi kunjungan dan hasil pemeriksaan Anda</small>
                            </div>
                        </div>
                        <button type="button" class="close-modal" data-dismiss="modal" aria-label="Tutup">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="detailLoading" class="detail-loading" style="display:none">
                            <i class="fas fa-spinner fa-spin"></i>
                            <span>Memuat detail pemeriksaan...</span>
                        </div>
                        <div id="detailError" class="alert alert-danger" style="display:none"></div>
                        <div id="riwayatDetailBody" class="detail-content"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-detail" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('css')
        <style>
            :root {
                --sage-dark: #253b33;
                --sage: #52796f;
                --sage-light: #e8efe7;
                --ivory: #f7f7f1;
                --text-main: #29372f;
                --text-muted: #7b877e;
                --border-soft: #e6e9e1;
            }

            .poli-page {
                color: var(--text-main);
                padding-bottom: 24px;
            }

            .poli-hero {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
                padding: 27px 30px;
                margin-bottom: 24px;
                border-radius: 18px;
                color: white;
                background: linear-gradient(120deg, #253b33, #52796f);
                box-shadow: 0 8px 24px rgba(37, 59, 51, .12);
            }

            .hero-eyebrow {
                display: inline-block;
                margin-bottom: 8px;
                color: #d2e1d4;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 1.8px;
            }

            .hero-copy h2 {
                margin: 0 0 8px;
                font-size: 26px;
                font-weight: 750;
            }

            .hero-copy p {
                max-width: 590px;
                margin: 0;
                color: #e0e9e0;
                font-size: 13px;
                line-height: 1.7;
            }

            .hero-actions {
                margin-top: 16px;
            }

            .hero-link {
                display: inline-flex;
                align-items: center;
                padding: 9px 13px;
                border: 1px solid rgba(255, 255, 255, .3);
                border-radius: 9px;
                color: white;
                background: rgba(255, 255, 255, .1);
                font-size: 12px;
                font-weight: 650;
                transition: .2s;
            }

            .hero-link:hover {
                background: white;
                color: var(--sage-dark);
                text-decoration: none;
            }

            .hero-icon {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 70px;
                height: 70px;
                border: 1px solid rgba(255, 255, 255, .2);
                border-radius: 21px;
                background: rgba(255, 255, 255, .12);
                font-size: 29px;
            }

            .form-card,
            .history-panel {
                height: 100%;
                border: 1px solid var(--border-soft);
                border-radius: 16px;
                background: white;
                box-shadow: 0 4px 18px rgba(37, 59, 51, .035);
                overflow: hidden;
            }

            .form-card {
                height: auto;
                padding: 23px;
            }

            .card-heading {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 25px;
            }

            .heading-icon,
            .panel-title-icon {
                display: grid;
                place-items: center;
                width: 44px;
                height: 44px;
                flex-shrink: 0;
                border-radius: 13px;
                background: var(--sage-light);
                color: var(--sage-dark);
                font-size: 18px;
            }

            .card-heading h5,
            .history-panel-heading h5 {
                margin: 0 0 5px;
                color: var(--sage-dark);
                font-size: 15px;
                font-weight: 750;
            }

            .card-heading p,
            .history-panel-heading p {
                margin: 0;
                color: var(--text-muted);
                font-size: 11px;
            }

            .step-indicator {
                display: flex;
                align-items: flex-start;
                gap: 11px;
                margin-bottom: 17px;
            }

            .step-number {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 27px;
                height: 27px;
                border-radius: 9px;
                background: var(--sage-dark);
                color: white;
                font-size: 11px;
                font-weight: 800;
            }

            .step-indicator strong {
                display: block;
                padding-top: 1px;
                color: var(--text-main);
                font-size: 12px;
            }

            .step-indicator small {
                display: block;
                margin-top: 3px;
                color: var(--text-muted);
                font-size: 10px;
            }

            .step-second {
                margin-top: 23px;
            }

            .form-card label {
                margin-bottom: 7px;
                color: var(--text-main);
                font-size: 12px;
                font-weight: 700;
            }

            .required {
                color: #bd5750;
            }

            .form-card .form-group {
                margin-bottom: 18px;
            }

            .input-icon-wrap {
                position: relative;
            }

            .input-icon-wrap>i {
                position: absolute;
                left: 13px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--sage);
                font-size: 13px;
            }

            .input-icon-wrap .form-control {
                padding-left: 37px;
                background: #f8f9f6;
            }

            .custom-select-field,
            .form-card .form-control {
                min-height: 42px;
                border: 1px solid #dfe5dc;
                border-radius: 9px;
                color: var(--text-main);
                font-size: 12px;
            }

            .custom-select-field:focus,
            .form-card .form-control:focus {
                border-color: var(--sage);
                box-shadow: 0 0 0 3px rgba(82, 121, 111, .11);
            }

            .custom-textarea {
                min-height: 100px;
                resize: vertical;
            }

            .field-hint {
                display: block;
                margin-top: 7px;
                color: var(--text-muted);
                font-size: 10px;
                line-height: 1.5;
            }

            .btn-register {
                width: 100%;
                padding: 12px 15px;
                border: 0;
                border-radius: 10px;
                background: var(--sage-dark);
                color: white;
                font-size: 12px;
                font-weight: 750;
                transition: .2s;
            }

            .btn-register:hover {
                background: var(--sage);
                transform: translateY(-1px);
            }

            .form-footnote {
                margin: 13px 0 0;
                text-align: center;
                color: var(--text-muted);
                font-size: 10px;
                line-height: 1.6;
            }

            .history-panel {
                height: auto;
            }

            .history-panel-heading {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                padding: 23px;
                border-bottom: 1px solid var(--border-soft);
            }

            .panel-title-icon {
                margin-bottom: 12px;
            }

            .total-badge {
                align-self: flex-start;
                padding: 7px 11px;
                border-radius: 20px;
                background: var(--sage-light);
                color: var(--sage-dark);
                font-size: 10px;
                font-weight: 750;
                white-space: nowrap;
            }

            .poli-table {
                min-width: 700px;
                margin: 0;
            }

            .poli-table thead th {
                padding: 14px 12px;
                border-top: 0;
                border-bottom: 1px solid var(--border-soft);
                background: #fafbf8;
                color: var(--text-muted);
                font-size: 9px;
                font-weight: 800;
                letter-spacing: .45px;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .poli-table tbody td {
                padding: 14px 12px;
                border-top: 1px solid #f0f2ed;
                color: var(--text-main);
                font-size: 11px;
                vertical-align: middle;
            }

            .poli-table tbody tr:hover {
                background: #fbfcf9;
            }

            .row-number {
                color: var(--text-muted) !important;
            }

            .poli-name {
                display: flex;
                align-items: center;
                gap: 9px;
                min-width: 135px;
            }

            .poli-avatar {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 34px;
                height: 34px;
                border-radius: 10px;
                background: var(--sage-light);
                color: var(--sage-dark);
            }

            .poli-name strong,
            .poli-name small,
            .schedule-info strong,
            .schedule-info small {
                display: block;
            }

            .poli-name strong {
                font-size: 11px;
                font-weight: 750;
            }

            .poli-name small {
                margin-top: 4px;
                color: var(--text-muted);
                font-size: 10px;
            }

            .schedule-info strong {
                font-size: 11px;
            }

            .schedule-info small {
                margin-top: 4px;
                color: var(--text-muted);
                font-size: 10px;
                white-space: nowrap;
            }

            .queue-number {
                display: inline-grid;
                place-items: center;
                min-width: 31px;
                height: 31px;
                padding: 0 7px;
                border: 1px solid var(--border-soft);
                border-radius: 9px;
                background: var(--ivory);
                color: var(--sage-dark);
                font-weight: 800;
            }

            .status-pill {
                display: inline-block;
                padding: 6px 9px;
                border-radius: 20px;
                font-size: 9px;
                font-weight: 750;
                white-space: nowrap;
            }

            .status-done {
                background: #e5f4e8;
                color: #287447;
            }

            .status-waiting {
                background: #fff3d9;
                color: #966816;
            }

            .btn-detail {
                padding: 7px 9px;
                border: 1px solid #dce7dd;
                border-radius: 8px;
                background: #f3f7f1;
                color: var(--sage-dark);
                font-size: 10px;
                font-weight: 750;
                white-space: nowrap;
                transition: .2s;
            }

            .btn-detail:hover {
                border-color: var(--sage);
                background: var(--sage-dark);
                color: white;
            }

            .no-detail {
                color: #9aa39b;
                font-size: 10px;
            }

            .empty-state {
                padding: 45px 20px;
                text-align: center;
            }

            .empty-icon {
                display: grid;
                place-items: center;
                width: 60px;
                height: 60px;
                margin: 0 auto 14px;
                border-radius: 19px;
                background: var(--ivory);
                color: var(--sage);
                font-size: 24px;
            }

            .empty-state h6 {
                margin-bottom: 7px;
                color: var(--sage-dark);
                font-size: 13px;
                font-weight: 750;
            }

            .empty-state p {
                margin: 0;
                color: var(--text-muted);
                font-size: 11px;
                line-height: 1.7;
            }

            .help-card {
                display: flex;
                gap: 13px;
                margin-top: 16px;
                padding: 17px;
                border: 1px solid #e4e9dd;
                border-radius: 13px;
                background: #f7f8f2;
            }

            .help-icon {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 34px;
                height: 34px;
                border-radius: 10px;
                background: #e7eddf;
                color: var(--sage-dark);
            }

            .help-card strong {
                display: block;
                margin: 1px 0 5px;
                color: var(--sage-dark);
                font-size: 11px;
            }

            .help-card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 10px;
                line-height: 1.7;
            }

            .custom-alert {
                border: 0;
                border-radius: 11px;
                font-size: 12px;
            }

            .detail-modal {
                border: 0;
                border-radius: 16px;
                overflow: hidden;
            }

            .detail-modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 23px;
                border: 0;
                background: var(--sage-dark);
                color: white;
            }

            .modal-title-wrap {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .modal-title-icon {
                display: grid;
                place-items: center;
                width: 42px;
                height: 42px;
                border-radius: 12px;
                background: rgba(255, 255, 255, .13);
                font-size: 18px;
            }

            .detail-modal .modal-title {
                margin: 0 0 4px;
                font-size: 15px;
                font-weight: 750;
            }

            .modal-title-wrap small {
                color: #d5e2d7;
                font-size: 10px;
            }

            .close-modal {
                border: 0;
                background: transparent;
                color: white;
                font-size: 18px;
                opacity: .8;
            }

            .close-modal:hover {
                opacity: 1;
            }

            .detail-modal .modal-body {
                padding: 23px;
            }

            .detail-content {
                display: grid;
                gap: 0;
            }

            .detail-row {
                display: grid;
                grid-template-columns: minmax(130px, .7fr) 1.5fr;
                gap: 15px;
                padding: 14px 0;
                border-bottom: 1px solid #edf0e9;
                font-size: 12px;
            }

            .detail-label {
                color: var(--text-muted);
                font-weight: 650;
            }

            .detail-value {
                color: var(--text-main);
                font-weight: 600;
                overflow-wrap: anywhere;
                white-space: pre-wrap;
            }

            .detail-loading {
                padding: 25px;
                text-align: center;
                color: var(--sage);
                font-size: 12px;
            }

            .detail-loading i {
                margin-right: 7px;
            }

            .btn-close-detail {
                padding: 9px 18px;
                border: 0;
                border-radius: 9px;
                background: var(--sage-dark);
                color: white;
                font-size: 11px;
                font-weight: 700;
            }

            @media (max-width: 576px) {
                .poli-hero {
                    padding: 22px 19px;
                }

                .hero-copy h2 {
                    font-size: 21px;
                }

                .hero-copy p {
                    font-size: 11px;
                }

                .hero-icon {
                    width: 48px;
                    height: 48px;
                    border-radius: 14px;
                    font-size: 20px;
                }

                .form-card {
                    padding: 18px;
                }

                .history-panel-heading {
                    padding: 18px;
                }

                .detail-modal .modal-body {
                    padding: 16px;
                }

                .detail-row {
                    grid-template-columns: 1fr;
                    gap: 6px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const poliSelect = document.getElementById('id_poli');
                const jadwalSelect = document.getElementById('jadwalSelect');

                async function loadJadwal(idPoli, selectedId = '') {
                    if (!idPoli) {
                        jadwalSelect.innerHTML = '<option value="">Pilih poli terlebih dahulu</option>';
                        return;
                    }

                    jadwalSelect.innerHTML = '<option value="">Memuat jadwal...</option>';
                    jadwalSelect.disabled = true;

                    try {
                        const response = await fetch(`/jadwal-periksa/poli/${encodeURIComponent(idPoli)}`);

                        if (!response.ok) {
                            throw new Error('Gagal mengambil jadwal.');
                        }

                        const data = await response.json();
                        jadwalSelect.innerHTML = '<option value="">Pilih jadwal dokter</option>';

                        if (!Array.isArray(data) || data.length === 0) {
                            jadwalSelect.innerHTML = '<option value="">Belum ada jadwal untuk poli ini</option>';
                            return;
                        }

                        data.forEach(function(jadwal) {
                            const option = document.createElement('option');
                            option.value = jadwal.id;

                            const dokter = jadwal.dokter?.name ?? 'Dokter tidak diketahui';
                            option.textContent =
                                `${dokter} - ${jadwal.hari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai})`;

                            if (String(jadwal.id) === String(selectedId)) {
                                option.selected = true;
                            }

                            jadwalSelect.appendChild(option);
                        });
                    } catch (error) {
                        jadwalSelect.innerHTML =
                            '<option value="">Gagal memuat jadwal. Coba pilih ulang poli.</option>';
                    } finally {
                        jadwalSelect.disabled = false;
                    }
                }

                poliSelect.addEventListener('change', function() {
                    loadJadwal(this.value);
                });

                // Mempertahankan pilihan poli dan jadwal apabila validasi form gagal.
                const oldPoli = @json(old('id_poli'));
                const oldJadwal = @json(old('id_jadwal'));

                if (oldPoli) {
                    poliSelect.value = oldPoli;
                    loadJadwal(oldPoli, oldJadwal);
                }
            });


            document.addEventListener('click', async function(event) {
                const button = event.target.closest('.js-detail-riwayat');

                if (!button) return;

                event.preventDefault();

                const id = button.dataset.id;
                const modalElement = document.getElementById('detailRiwayatModal');
                const body = document.getElementById('riwayatDetailBody');
                const loading = document.getElementById('detailLoading');
                const errorBox = document.getElementById('detailError');

                if (!modalElement || !body || !loading || !errorBox) {
                    console.error('Elemen modal Detail tidak ditemukan.');
                    alert('Komponen detail tidak ditemukan. Silakan periksa struktur modal.');
                    return;
                }

                body.replaceChildren();
                errorBox.style.display = 'none';
                loading.style.display = 'block';
                button.disabled = true;

                // Tampilkan modal menggunakan Bootstrap yang tersedia.
                if (window.jQuery && typeof window.jQuery.fn.modal === 'function') {
                    window.jQuery(modalElement).modal('show');
                } else if (window.bootstrap?.Modal) {
                    window.bootstrap.Modal.getOrCreateInstance(modalElement).show();
                }

                try {
                    const response = await fetch(
                        `/pasien/poli/${encodeURIComponent(id)}/detail`, {
                            method: 'GET',
                            headers: {
                                Accept: 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            credentials: 'same-origin'
                        }
                    );

                    if (!response.ok) {
                        let message = `Permintaan gagal (HTTP ${response.status}).`;

                        try {
                            const result = await response.json();
                            message = result.message || message;
                        } catch (_) {}

                        throw new Error(message);
                    }

                    const result = await response.json();
                    const p = result.pendaftaran;

                    if (!p) {
                        throw new Error('Data pendaftaran tidak ditemukan dalam respons server.');
                    }

                    const rows = [
                        ['Nomor Antrean', p.no_antrian ?? '-'],
                        ['Nama Pasien', p.nama_pasien ?? '-'],
                        ['Tanggal Kunjungan', p.tanggal_kunjungan ?? '-'],
                        ['Poli', p.nama_poli ?? '-'],
                        ['Dokter', p.nama_dokter ?? '-'],
                        ['Hari Praktik', p.hari ?? '-'],
                        ['Jam Praktik', `${p.jam_mulai ?? '-'} - ${p.jam_selesai ?? '-'}`],
                        ['Keluhan', p.keluhan ?? '-']
                    ];

                    if (p.pemeriksaan) {
                        const periksa = p.pemeriksaan;

                        rows.push(
                            ['Tanggal Pemeriksaan', periksa.tanggal ?? '-'],
                            ['Catatan Dokter', periksa.catatan ?? '-'],
                            [
                                'Obat',
                                Array.isArray(periksa.obat) && periksa.obat.length ?
                                periksa.obat.join(', ') :
                                'Tidak ada obat yang tercatat'
                            ],
                            [
                                'Biaya Pemeriksaan',
                                periksa.biaya !== null && periksa.biaya !== undefined ?
                                'Rp ' + Number(periksa.biaya).toLocaleString('id-ID') :
                                'Belum tercatat'
                            ]
                        );
                    } else {
                        rows.push([
                            'Status Pemeriksaan',
                            'Belum ada hasil pemeriksaan dari dokter.'
                        ]);
                    }

                    rows.forEach(([labelText, valueText]) => {
                        const row = document.createElement('div');
                        row.className = 'detail-row';

                        const label = document.createElement('div');
                        label.className = 'detail-label';
                        label.textContent = labelText;

                        const value = document.createElement('div');
                        value.className = 'detail-value';
                        value.textContent = String(valueText ?? '-');

                        row.append(label, value);
                        body.appendChild(row);
                    });
                } catch (error) {
                    console.error('Gagal memuat detail pendaftaran:', error);
                    errorBox.textContent = error.message || 'Terjadi kesalahan saat memuat detail.';
                    errorBox.style.display = 'block';
                } finally {
                    loading.style.display = 'none';
                    button.disabled = false;
                }
            });
        </script>
    @endpush
