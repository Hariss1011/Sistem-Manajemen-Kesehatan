@extends('layouts.app')

@section('title', 'Daftar Periksa Pasien')

@section('content_body')
    <style>
        .exam-page {
            color: #29372f;
        }

        .exam-page .exam-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        .exam-page .exam-subtitle {
            margin: 6px 0 0;
            color: #7b877e;
            font-size: 13px;
        }

        .exam-page .exam-stat {
            height: 100%;
            padding: 19px;
            border: 1px solid #e6e9e1;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(37, 59, 51, .035);
        }

        .exam-page .stat-label {
            color: #7b877e;
            font-size: 12px;
            font-weight: 600;
        }

        .exam-page .stat-value {
            margin-top: 8px;
            color: #304b40;
            font-size: 27px;
            font-weight: 750;
        }

        .exam-page .stat-icon {
            display: flex;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e8efe7;
            color: #52796f;
            font-size: 17px;
        }

        .exam-page .exam-card {
            overflow: hidden;
            border: 1px solid #e6e9e1;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(37, 59, 51, .045);
        }

        .exam-page .exam-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 20px 22px;
            border-bottom: 1px solid #edf0e9;
        }

        .exam-page .exam-card-header h5 {
            margin: 0;
            color: #304b40;
            font-size: 16px;
            font-weight: 750;
        }

        .exam-page .exam-card-header p {
            margin: 5px 0 0;
            color: #7b877e;
            font-size: 12px;
        }

        .exam-page .search-form {
            display: flex;
            gap: 8px;
            width: 100%;
            max-width: 350px;
        }

        .exam-page .search-input {
            min-width: 0;
            height: 39px;
            padding: 8px 12px;
            border: 1px solid #dfe5dc;
            border-radius: 9px;
            outline: none;
            font-size: 12px;
        }

        .exam-page .search-input:focus {
            border-color: #84a98c;
            box-shadow: 0 0 0 3px rgba(132, 169, 140, .15);
        }

        .exam-page .btn-search {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 12px;
            border: 0;
            border-radius: 9px;
            background: #52796f;
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        .exam-page .btn-search:hover {
            background: #3d6253;
        }

        .exam-page .table {
            margin: 0;
        }

        .exam-page .table thead th {
            padding: 14px 18px;
            border-top: 0;
            border-bottom: 1px solid #e6e9e1;
            background: #f7f7f1;
            color: #68756c;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .exam-page .table tbody td {
            padding: 16px 18px;
            border-top: 1px solid #f0f1ec;
            color: #39463e;
            font-size: 13px;
            vertical-align: middle;
        }

        .exam-page .table tbody tr:hover {
            background: #fbfcf9;
        }

        .exam-page .queue-number {
            display: inline-flex;
            min-width: 38px;
            height: 34px;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #e8efe7;
            color: #3d6253;
            font-weight: 750;
        }

        .exam-page .patient-name {
            color: #304b40;
            font-weight: 700;
        }

        .exam-page .patient-caption {
            margin-top: 4px;
            color: #929b93;
            font-size: 11px;
        }

        .exam-page .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .exam-page .status-pending {
            background: #fff3dc;
            color: #986a19;
        }

        .exam-page .status-done {
            background: #e8efe7;
            color: #3d6253;
        }

        .exam-page .btn-exam {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 12px;
            border: 0;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: .2s ease;
        }

        .exam-page .btn-exam-primary {
            background: #52796f;
            color: #fff;
        }

        .exam-page .btn-exam-primary:hover {
            background: #3d6253;
            color: #fff;
        }

        .exam-page .btn-exam-edit {
            background: #e8efe7;
            color: #3d6253;
        }

        .exam-page .btn-exam-edit:hover {
            background: #d9e5d8;
            color: #253b33;
        }

        .exam-page .empty-state {
            padding: 45px 20px !important;
            text-align: center;
        }

        .exam-page .empty-icon {
            display: flex;
            width: 56px;
            height: 56px;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            border-radius: 17px;
            background: #e8efe7;
            color: #52796f;
            font-size: 22px;
        }

        .exam-page .empty-state h6 {
            margin-bottom: 6px;
            color: #304b40;
            font-weight: 700;
        }

        .exam-page .empty-state p {
            margin: 0;
            color: #7b877e;
            font-size: 13px;
        }

        .exam-page .pagination {
            margin: 0;
        }

        .exam-page .pagination .page-link {
            border-color: #e6e9e1;
            color: #52796f;
            font-size: 12px;
        }

        .exam-page .pagination .page-item.active .page-link {
            border-color: #52796f;
            background: #52796f;
            color: #fff;
        }

        .exam-page .alert-success {
            border: 1px solid #dce7da;
            border-radius: 10px;
            background: #f2f8f0;
            color: #3d6253;
            font-size: 13px;
        }

        .exam-page .alert-info {
            border: 1px solid #dce7da;
            border-radius: 10px;
            background: #f7faf5;
            color: #3d6253;
            font-size: 13px;
        }

        @media (max-width: 767px) {

            .exam-page .exam-heading,
            .exam-page .exam-card-header {
                align-items: stretch;
                flex-direction: column;
            }

            .exam-page .search-form {
                max-width: none;
            }

            .exam-page .table thead th,
            .exam-page .table tbody td {
                padding: 12px;
            }
        }
    </style>

    @php
        $jumlahPasien = $pendaftarans->total();

        $jumlahSelesai = (clone $pendaftarans->getCollection())
            ->filter(function ($pendaftaran) {
                $periksa = $pendaftaran->periksa;

                return $periksa && (filled($periksa->catatan) || $periksa->detailPeriksa->isNotEmpty());
            })
            ->count();

        $jumlahMenunggu = max(0, $jumlahPasien - $jumlahSelesai);
    @endphp

    <div class="exam-page">
        <div class="exam-heading">
            <div>
                <h4 style="margin:0;color:#304b40;font-weight:750;">Pemeriksaan Pasien</h4>
                <p class="exam-subtitle">
                    Kelola catatan pemeriksaan dan obat yang diberikan kepada pasien.
                </p>
            </div>

            <div
                style="padding:9px 13px;border:1px solid #e6e9e1;border-radius:10px;background:#fff;color:#52796f;font-size:12px;font-weight:700;">
                <i class="fas fa-calendar-day mr-1"></i>
                {{ now()->translatedFormat('d F Y') }}
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-3">
                <i class="fas fa-check-circle mr-1"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info mb-3">
                <i class="fas fa-info-circle mr-1"></i>
                {{ session('info') }}
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <div class="exam-stat">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stat-label">Total Pendaftaran</div>
                            <div class="stat-value">{{ $jumlahPasien }}</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div style="margin-top:8px;color:#929b93;font-size:11px;">
                        Seluruh pendaftaran yang tersedia
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="exam-stat">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stat-label">Belum Selesai</div>
                            <div class="stat-value">{{ $jumlahMenunggu }}</div>
                        </div>
                        <div class="stat-icon" style="background:#fff3dc;color:#986a19;">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div style="margin-top:8px;color:#929b93;font-size:11px;">
                        Belum diperiksa atau belum lengkap
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="exam-stat">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stat-label">Sudah Ditangani</div>
                            <div class="stat-value">{{ $jumlahSelesai }}</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div style="margin-top:8px;color:#929b93;font-size:11px;">
                        Data pada halaman saat ini
                    </div>
                </div>
            </div>
        </div>

        <div class="exam-card">
            <div class="exam-card-header">
                <div>
                    <h5>
                        <i class="fas fa-stethoscope mr-2" style="color:#688f80;"></i>
                        Daftar Periksa Pasien
                    </h5>
                    <p>Pilih pasien untuk memulai pemeriksaan atau memperbarui hasilnya.</p>
                </div>

                <form action="{{ route('memeriksa.index') }}" method="GET" class="search-form">
                    <input type="text" name="search" class="search-input flex-grow-1" value="{{ request('search') }}"
                        placeholder="Cari nama pasien atau No. RM...">
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i> Cari
                    </button>

                    @if (request()->filled('search'))
                        <a href="{{ route('memeriksa.index') }}" class="btn-exam btn-exam-edit" style="padding:8px 10px;"
                            title="Reset pencarian">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:90px;">No. Urut</th>
                            <th>Nama Pasien</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th style="width:140px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftarans as $pendaftaran)
                            @php
                                $periksa = $pendaftaran->periksa;
                                $sudahDiperiksa =
                                    $periksa && (filled($periksa->catatan) || $periksa->detailPeriksa->isNotEmpty());
                            @endphp

                            <tr>
                                <td>
                                    <span class="queue-number">
                                        {{ $pendaftaran->no_antrian ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="patient-name">
                                        {{ $pendaftaran->pasien->name ?? '-' }}
                                    </div>
                                    <div class="patient-caption">
                                        No. RM: {{ $pendaftaran->pasien->no_rm ?? '-' }}
                                    </div>
                                </td>

                                <td style="min-width:200px;max-width:360px;">
                                    {{ $pendaftaran->keluhan ?: 'Belum ada keluhan yang dicatat.' }}
                                </td>

                                <td>
                                    @if ($sudahDiperiksa)
                                        <span class="status-pill status-done">
                                            <i class="fas fa-check-circle"></i> Sudah ditangani
                                        </span>
                                    @else
                                        <span class="status-pill status-pending">
                                            <i class="fas fa-clock"></i> Belum diperiksa
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($sudahDiperiksa)
                                        <a href="{{ route('memeriksa.edit', $pendaftaran->id) }}"
                                            class="btn-exam btn-exam-edit">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    @else
                                        <a href="{{ route('memeriksa.show', $pendaftaran->id) }}"
                                            class="btn-exam btn-exam-primary">
                                            <i class="fas fa-stethoscope"></i> Periksa
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <h6>Tidak ada data pasien</h6>
                                    <p>
                                        @if (request()->filled('search'))
                                            Pasien dengan kata kunci tersebut tidak ditemukan.
                                        @else
                                            Belum ada pendaftaran yang tersedia untuk diperiksa.
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pendaftarans->hasPages())
                <div class="d-flex align-items-center justify-content-between flex-wrap"
                    style="gap:12px;padding:17px 22px;border-top:1px solid #edf0e9;">
                    <div style="color:#7b877e;font-size:12px;">
                        Menampilkan {{ $pendaftarans->firstItem() ?? 0 }}
                        – {{ $pendaftarans->lastItem() ?? 0 }}
                        dari {{ $pendaftarans->total() }} pendaftaran
                    </div>

                    {{ $pendaftarans->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
