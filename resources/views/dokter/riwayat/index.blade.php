@extends('layouts.app')

@section('subtitle', 'Riwayat Pasien')

@section('content_body')
    <div class="doctor-history-page">
        {{-- Header --}}
        <div class="history-heading">
            <div>
                <span class="section-eyebrow">REKAM MEDIS</span>
                <h2>Riwayat Pasien</h2>
                <p>Lihat data pasien dan riwayat pemeriksaan yang pernah dilakukan.</p>
            </div>

            <div class="history-heading-icon">
                <i class="fas fa-file-medical-alt"></i>
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="row mb-3">
            <div class="col-md-6 col-xl-4 mb-3">
                <div class="history-stat-card">
                    <div class="history-stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <span>Total Pasien</span>
                        <h3>{{ $pasiens->count() }}</h3>
                        <small>Pasien dalam daftar riwayat</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 mb-3">
                <div class="history-stat-card">
                    <div class="history-stat-icon stat-icon-secondary">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div>
                        <span>Data Rekam Medis</span>
                        <h3><i class="fas fa-notes-medical"></i></h3>
                        <small>Catatan pemeriksaan pasien</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel pasien --}}
        <div class="history-card">
            <div class="history-card-header">
                <div class="history-card-title">
                    <div class="title-icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <div>
                        <h5>Daftar Pasien</h5>
                        <p>Pilih pasien untuk melihat detail riwayat pemeriksaannya.</p>
                    </div>
                </div>

                <div class="history-search">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchPasien" placeholder="Cari nama, No. RM, atau telepon..."
                        aria-label="Cari pasien">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table history-table mb-0" id="pasienTable">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Pasien</th>
                            <th>Nomor Rekam Medis</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasiens as $i => $pasien)
                            <tr>
                                <td class="text-center text-muted">
                                    {{ $i + 1 }}
                                </td>

                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <span class="patient-name">{{ $pasien->name }}</span>
                                            <small>Pasien klinik</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="medical-record-number">
                                        {{ $pasien->no_rm ?: '-' }}
                                    </span>
                                </td>

                                <td class="patient-address">
                                    {{ $pasien->alamat ?: '-' }}
                                </td>

                                <td>
                                    {{ $pasien->no_hp ?: '-' }}
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn-history-detail" data-id="{{ $pasien->id }}"
                                        data-name="{{ $pasien->name }}">
                                        <i class="fas fa-eye mr-1"></i>
                                        Lihat Riwayat
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <h6>Belum Ada Data Pasien</h6>
                                    <p>Daftar pasien akan ditampilkan di sini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="searchEmptyState" class="search-empty-state d-none">
                <i class="fas fa-search"></i>
                <p>Pasien yang dicari tidak ditemukan.</p>
            </div>

            <div class="history-card-footer">
                <span>
                    <i class="fas fa-info-circle mr-1"></i>
                    Pilih <strong>Lihat Riwayat</strong> untuk melihat rekam medis pasien.
                </span>
            </div>
        </div>
    </div>

    {{-- Modal riwayat --}}
    <div class="modal fade" id="riwayatModal" tabindex="-1" role="dialog" aria-labelledby="riwayatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content history-modal">
                <div class="modal-header history-modal-header">
                    <div class="modal-patient-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <div class="modal-title-wrapper">
                        <span>REKAM MEDIS PASIEN</span>
                        <h5 class="modal-title" id="riwayatModalLabel">
                            Riwayat Pemeriksaan
                        </h5>
                        <p id="namaPasien">Memuat data pasien...</p>
                    </div>

                    <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="riwayatLoading" class="history-loading">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Memuat...</span>
                        </div>
                        <p>Memuat riwayat pemeriksaan...</p>
                    </div>

                    <div id="riwayatError" class="history-error d-none">
                        <i class="fas fa-exclamation-circle"></i>
                        <p id="riwayatErrorMessage">
                            Riwayat pasien gagal dimuat.
                        </p>
                        <button type="button" class="btn-retry" id="retryRiwayat">
                            <i class="fas fa-redo mr-1"></i> Coba Lagi
                        </button>
                    </div>

                    <div id="riwayatContent" class="d-none">
                        <div class="history-result-summary">
                            <div>
                                <span>Total Riwayat</span>
                                <strong id="jumlahRiwayat">0 pemeriksaan</strong>
                            </div>
                            <div class="result-summary-icon">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table modal-history-table mb-0" id="tableRiwayat">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Dokter</th>
                                        <th>Keluhan</th>
                                        <th>Catatan Pemeriksaan</th>
                                        <th>Obat</th>
                                        <th>Biaya</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div id="riwayatEmpty" class="empty-history d-none">
                            <i class="fas fa-folder-open"></i>
                            <h6>Belum Ada Riwayat Pemeriksaan</h6>
                            <p>Belum terdapat catatan pemeriksaan untuk pasien ini.</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer history-modal-footer">
                    <button type="button" class="btn-close-modal" data-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
    <style>
        .doctor-history-page {
            color: #29372f;
        }

        .history-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 23px;
        }

        .section-eyebrow {
            color: #688f80;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .history-heading h2 {
            margin: 5px 0 6px;
            color: #253b33;
            font-size: 27px;
            font-weight: 750;
        }

        .history-heading p {
            margin: 0;
            color: #7b877e;
            font-size: 13px;
        }

        .history-heading-icon {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: #e8efe7;
            color: #52796f;
            font-size: 23px;
        }

        .history-stat-card {
            display: flex;
            align-items: center;
            gap: 16px;
            height: 100%;
            min-height: 115px;
            padding: 21px;
            background: #fff;
            border: 1px solid #e6e9e1;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(37, 59, 51, .035);
        }

        .history-stat-icon {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #e8efe7;
            color: #52796f;
            font-size: 20px;
        }

        .stat-icon-secondary {
            background: #f3f0e5;
            color: #9b8755;
        }

        .history-stat-card span {
            display: block;
            margin-bottom: 4px;
            color: #7b877e;
            font-size: 11px;
        }

        .history-stat-card h3 {
            margin: 0 0 4px;
            color: #304b40;
            font-size: 23px;
            font-weight: 800;
        }

        .history-stat-card h3 i {
            font-size: 19px;
        }

        .history-stat-card small {
            color: #8a948b;
            font-size: 10px;
        }

        .history-card {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e6e9e1;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(37, 59, 51, .045);
        }

        .history-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            padding: 22px 24px;
            border-bottom: 1px solid #edf0e9;
        }

        .history-card-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .title-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e8efe7;
            color: #52796f;
            font-size: 17px;
        }

        .history-card-title h5 {
            margin: 0 0 5px;
            color: #304b40;
            font-size: 15px;
            font-weight: 750;
        }

        .history-card-title p {
            margin: 0;
            color: #7b877e;
            font-size: 11px;
        }

        .history-search {
            position: relative;
            width: 310px;
            max-width: 100%;
        }

        .history-search i {
            position: absolute;
            top: 13px;
            left: 13px;
            color: #8a9b8e;
            font-size: 12px;
        }

        .history-search input {
            width: 100%;
            height: 40px;
            padding: 9px 12px 9px 36px;
            border: 1px solid #e2e8df;
            border-radius: 9px;
            outline: none;
            background: #fcfdfb;
            color: #29372f;
            font-size: 11px;
            transition: border-color .2s, box-shadow .2s;
        }

        .history-search input:focus {
            border-color: #84a98c;
            box-shadow: 0 0 0 3px rgba(132, 169, 140, .13);
        }

        .history-table {
            min-width: 850px;
        }

        .history-table thead th {
            padding: 15px 16px;
            border-top: 0;
            border-bottom: 1px solid #e9ede5;
            background: #f7f7f1;
            color: #6c7b70;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .history-table tbody td {
            padding: 15px 16px;
            border-top: 1px solid #f0f2ed;
            color: #526056;
            font-size: 12px;
            vertical-align: middle;
        }

        .history-table tbody tr {
            transition: background .15s;
        }

        .history-table tbody tr:hover {
            background: #fbfcf9;
        }

        .patient-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 170px;
        }

        .patient-avatar {
            width: 37px;
            height: 37px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 11px;
            background: #e8efe7;
            color: #52796f;
            font-size: 14px;
        }

        .patient-name {
            display: block;
            color: #304b40;
            font-size: 12px;
            font-weight: 750;
        }

        .patient-cell small {
            display: block;
            margin-top: 3px;
            color: #8a948b;
            font-size: 10px;
        }

        .medical-record-number {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 6px;
            background: #f0f4ee;
            color: #52796f;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .patient-address {
            max-width: 210px;
            min-width: 150px;
        }

        .btn-history-detail {
            padding: 8px 11px;
            border: 1px solid #d8e5d9;
            border-radius: 8px;
            background: #edf4ed;
            color: #3d6253;
            font-size: 10px;
            font-weight: 750;
            white-space: nowrap;
            transition: all .2s;
        }

        .btn-history-detail:hover {
            border-color: #3d6253;
            background: #3d6253;
            color: #fff;
        }

        .history-card-footer {
            padding: 14px 23px;
            border-top: 1px solid #edf0e9;
            background: #fcfdfb;
            color: #7b877e;
            font-size: 10px;
        }

        .empty-state {
            padding: 45px 20px !important;
            text-align: center;
        }

        .empty-state-icon {
            margin-bottom: 12px;
            color: #a9b8aa;
            font-size: 32px;
        }

        .empty-state h6 {
            color: #304b40;
            font-weight: 750;
        }

        .empty-state p,
        .search-empty-state p {
            margin: 5px 0 0;
            color: #7b877e;
            font-size: 12px;
        }

        .search-empty-state {
            padding: 30px;
            text-align: center;
            color: #91a394;
        }

        .search-empty-state>i {
            font-size: 25px;
        }

        /* Modal detail riwayat */
        .history-modal {
            overflow: hidden;
            border: 0;
            border-radius: 17px;
            box-shadow: 0 15px 50px rgba(24, 44, 35, .15);
        }

        .history-modal-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 23px 25px;
            border-bottom: 1px solid #e5ebe2;
            background: #f7f7f1;
        }

        .modal-patient-icon {
            width: 49px;
            height: 49px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 14px;
            background: #dfeadf;
            color: #3d6253;
            font-size: 20px;
        }

        .modal-title-wrapper {
            min-width: 0;
        }

        .modal-title-wrapper>span {
            color: #688f80;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .modal-title-wrapper .modal-title {
            margin-top: 3px;
            color: #253b33;
            font-size: 17px;
            font-weight: 800;
        }

        .modal-title-wrapper p {
            margin: 4px 0 0;
            color: #7b877e;
            font-size: 11px;
        }

        .modal-close {
            margin-left: auto;
            color: #65756a;
            opacity: 1;
            text-shadow: none;
        }

        .history-modal .modal-body {
            min-height: 200px;
            padding: 24px;
        }

        .history-result-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px;
            margin-bottom: 22px;
            border: 1px solid #e5ebe2;
            border-radius: 12px;
            background: #fbfcf9;
        }

        .history-result-summary span {
            display: block;
            margin-bottom: 5px;
            color: #7b877e;
            font-size: 10px;
        }

        .history-result-summary strong {
            color: #304b40;
            font-size: 14px;
        }

        .result-summary-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #e8efe7;
            color: #52796f;
            font-size: 17px;
        }

        .modal-history-table {
            min-width: 1000px;
        }

        .modal-history-table thead th {
            padding: 12px;
            border-top: 0;
            border-bottom: 1px solid #e6e9e1;
            background: #f7f7f1;
            color: #6c7b70;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .modal-history-table tbody td {
            padding: 13px 12px;
            border-top: 1px solid #f0f2ed;
            color: #526056;
            font-size: 11px;
            vertical-align: top;
        }

        .history-loading,
        .history-error,
        .empty-history {
            padding: 38px 15px;
            text-align: center;
        }

        .history-loading .spinner-border {
            width: 32px;
            height: 32px;
            color: #52796f;
        }

        .history-loading p {
            margin: 13px 0 0;
            color: #7b877e;
            font-size: 12px;
        }

        .history-error>i,
        .empty-history>i {
            margin-bottom: 12px;
            color: #8aab91;
            font-size: 32px;
        }

        .history-error p,
        .empty-history p {
            color: #7b877e;
            font-size: 12px;
        }

        .empty-history h6 {
            color: #304b40;
            font-weight: 750;
        }

        .btn-retry,
        .btn-close-modal {
            padding: 9px 15px;
            border: 1px solid #d8e5d9;
            border-radius: 8px;
            background: #edf4ed;
            color: #3d6253;
            font-size: 11px;
            font-weight: 750;
        }

        .history-modal-footer {
            padding: 14px 24px;
            border-top: 1px solid #e9ede5;
            background: #fcfdfb;
        }

        .btn-close-modal {
            background: #3d6253;
            color: #fff;
        }

        .btn-close-modal:hover {
            background: #304b40;
            color: #fff;
        }

        @media (max-width: 767px) {
            .history-heading h2 {
                font-size: 23px;
            }

            .history-card-header {
                align-items: stretch;
                flex-direction: column;
                padding: 18px;
            }

            .history-search {
                width: 100%;
            }

            .history-modal-header,
            .history-modal .modal-body {
                padding: 18px;
            }

            .modal-title-wrapper .modal-title {
                font-size: 15px;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchPasien');
            const pasienTable = document.getElementById('pasienTable');
            const searchEmptyState = document.getElementById('searchEmptyState');

            let activePatientId = null;
            let activePatientName = '';

            function escapeHtml(value) {
                return String(value ?? '').replace(/[&<>"']/g, function(character) {
                    return {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    } [character];
                });
            }

            function formatCurrency(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(Number(value) || 0);
            }

            function formatDate(value) {
                if (!value) return '-';

                const datePart = String(value).split('T')[0].split(' ')[0];
                const parts = datePart.split('-');

                if (parts.length !== 3) return value;

                const date = new Date(
                    Number(parts[0]),
                    Number(parts[1]) - 1,
                    Number(parts[2])
                );

                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }

            if (searchInput && pasienTable) {
                searchInput.addEventListener('input', function() {
                    const keyword = this.value.trim().toLowerCase();
                    const rows = pasienTable.querySelectorAll('tbody tr');
                    let visibleCount = 0;

                    rows.forEach(function(row) {
                        if (row.querySelector('.empty-state')) return;

                        const matches = row.textContent.toLowerCase().includes(keyword);
                        row.style.display = matches ? '' : 'none';

                        if (matches) visibleCount++;
                    });

                    searchEmptyState.classList.toggle(
                        'd-none',
                        keyword.length === 0 || visibleCount > 0
                    );
                });
            }

            function setModalState(state) {
                document.getElementById('riwayatLoading').classList.toggle(
                    'd-none', state !== 'loading'
                );
                document.getElementById('riwayatError').classList.toggle(
                    'd-none', state !== 'error'
                );
                document.getElementById('riwayatContent').classList.toggle(
                    'd-none', state !== 'content'
                );
            }

            async function loadRiwayat(id, nama) {
                activePatientId = id;
                activePatientName = nama;

                document.getElementById('namaPasien').textContent = nama;
                document.getElementById('riwayatErrorMessage').textContent =
                    'Riwayat pasien gagal dimuat. Silakan coba kembali.';
                document.querySelector('#tableRiwayat tbody').innerHTML = '';

                setModalState('loading');

                if (window.jQuery) {
                    window.jQuery('#riwayatModal').modal('show');
                }

                try {
                    const response = await fetch(
                        `/dokter/riwayat-pasien/${encodeURIComponent(id)}`, {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }
                    );

                    if (!response.ok) {
                        throw new Error('Server mengembalikan status ' + response.status);
                    }

                    const data = await response.json();
                    const riwayats = Array.isArray(data.riwayats) ? data.riwayats : [];
                    const tbody = document.querySelector('#tableRiwayat tbody');

                    document.getElementById('jumlahRiwayat').textContent =
                        riwayats.length + (riwayats.length === 1 ? ' pemeriksaan' : ' pemeriksaan');

                    if (riwayats.length === 0) {
                        document.getElementById('riwayatEmpty').classList.remove('d-none');
                        pasienTable.setAttribute('data-riwayat-loaded', 'true');
                    } else {
                        document.getElementById('riwayatEmpty').classList.add('d-none');

                        tbody.innerHTML = riwayats.map(function(r, index) {
                            const details = Array.isArray(r.detail_periksa) ?
                                r.detail_periksa : [];

                            const obatList = details.length ?
                                details.map(function(detail) {
                                    return escapeHtml(detail.obat?.nama_obat || '-');
                                }).join(', ') :
                                '-';

                            const dokter = r.daftar_poli?.jadwal_periksa?.dokter?.name || '-';
                            const keluhan = r.daftar_poli?.keluhan || '-';
                            const catatan = r.catatan || '-';

                            return `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${escapeHtml(formatDate(r.tgl_periksa))}</td>
                                    <td>${escapeHtml(dokter)}</td>
                                    <td>${escapeHtml(keluhan)}</td>
                                    <td>${escapeHtml(catatan)}</td>
                                    <td>${obatList}</td>
                                    <td><strong>${escapeHtml(formatCurrency(r.biaya_periksa))}</strong></td>
                                </tr>
                            `;
                        }).join('');
                    }

                    setModalState('content');
                } catch (error) {
                    console.error('Gagal memuat riwayat pasien:', error);

                    document.getElementById('riwayatErrorMessage').textContent =
                        'Riwayat tidak dapat dimuat. Periksa koneksi atau coba kembali.';
                    setModalState('error');
                }
            }

            document.querySelectorAll('.btn-history-detail').forEach(function(button) {
                button.addEventListener('click', function() {
                    loadRiwayat(this.dataset.id, this.dataset.name);
                });
            });

            document.getElementById('retryRiwayat').addEventListener('click', function() {
                if (activePatientId !== null) {
                    loadRiwayat(activePatientId, activePatientName);
                }
            });
        });
    </script>
@endpush
