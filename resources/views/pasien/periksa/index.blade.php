@extends('layouts.app')

@section('content_header_title', 'Periksa')
@section('subtitle', 'Riwayat dan hasil pemeriksaan kesehatan')

@section('content_body')
    <div class="patient-page">

        <div class="page-heading">
            <div>
                <span class="eyebrow">LAYANAN KESEHATAN</span>
                <h2>Riwayat Pemeriksaan</h2>
                <p>
                    Pantau hasil pemeriksaan, catatan dokter, dan obat yang diberikan.
                </p>
            </div>

            <div class="heading-icon">
                <i class="fas fa-stethoscope"></i>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-file-medical-alt"></i>
            </div>
            <div>
                <span class="summary-label">Total Pemeriksaan</span>
                <h3>{{ $periksas->count() }}</h3>
                <p>Riwayat pemeriksaan yang tercatat pada akun Anda.</p>
            </div>
        </div>

        <div class="history-card">
            <div class="history-header">
                <div>
                    <h4>Riwayat Medis</h4>
                    <p>Informasi pemeriksaan yang telah dicatat oleh dokter.</p>
                </div>

                <span class="history-count">
                    {{ $periksas->count() }} data
                </span>
            </div>

            @if ($periksas->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-notes-medical"></i>
                    </div>

                    <h5>Belum Ada Riwayat Pemeriksaan</h5>

                    <p>
                        Hasil pemeriksaan akan muncul di sini setelah dokter
                        mencatat pemeriksaan Anda.
                    </p>

                    <a href="{{ route('pasien.poli.index') }}" class="btn-poli">
                        <i class="fas fa-hospital mr-2"></i>
                        Lihat Daftar Poli
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table examination-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Dokter</th>
                                <th>Tanggal</th>
                                <th>Keluhan</th>
                                <th>Catatan Dokter</th>
                                <th>Obat</th>
                                <th>Biaya</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($periksas as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>
                                        <div class="doctor-cell">
                                            <div class="doctor-avatar">
                                                <i class="fas fa-user-md"></i>
                                            </div>
                                            <span>
                                                {{ $p->dokter->name ?? 'Dokter tidak tersedia' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $p->tgl_periksa ? $p->tgl_periksa->format('d M Y, H:i') : '-' }}
                                    </td>

                                    <td>
                                        {{ $p->daftarPoli->keluhan ?? '-' }}
                                    </td>

                                    <td class="notes-cell">
                                        {{ $p->catatan ?: 'Belum ada catatan' }}
                                    </td>

                                    <td>
                                        @forelse ($p->detailPeriksa as $detail)
                                            <span class="medicine-item">
                                                {{ $detail->obat->nama_obat ?? ($detail->obat->nama ?? 'Obat tidak tersedia') }}
                                            </span>
                                        @empty
                                            <span class="muted-text">Tidak ada obat</span>
                                        @endforelse
                                    </td>

                                    <td class="cost-cell">
                                        {{ $p->biaya_periksa !== null ? 'Rp ' . number_format($p->biaya_periksa, 0, ',', '.') : '-' }}
                                    </td>

                                    <td>
                                        @if ($p->tgl_periksa && $p->catatan)
                                            <span class="status-pill status-complete">
                                                <i class="fas fa-check-circle"></i>
                                                Selesai
                                            </span>
                                        @else
                                            <span class="status-pill status-pending">
                                                <i class="fas fa-clock"></i>
                                                Belum lengkap
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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

        .patient-page {
            color: var(--text-main);
            padding-bottom: 24px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 28px 30px;
            margin-bottom: 22px;
            border-radius: 18px;
            background: linear-gradient(120deg, #e8efe7, #f7f7f1);
        }

        .eyebrow {
            display: inline-block;
            margin-bottom: 8px;
            color: var(--sage);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .page-heading h2 {
            margin: 0 0 8px;
            color: var(--sage-dark);
            font-size: 27px;
            font-weight: 750;
        }

        .page-heading p {
            margin: 0;
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .heading-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 68px;
            height: 68px;
            border-radius: 20px;
            background: white;
            color: var(--sage);
            font-size: 27px;
            box-shadow: 0 5px 18px rgba(37, 59, 51, .07);
        }

        .summary-card {
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 22px 25px;
            margin-bottom: 22px;
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 16px;
        }

        .summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            border-radius: 15px;
            background: var(--sage-light);
            color: var(--sage);
            font-size: 21px;
        }

        .summary-label {
            color: var(--text-muted);
            font-size: 13px;
        }

        .summary-card h3 {
            margin: 3px 0;
            color: var(--sage-dark);
            font-size: 25px;
            font-weight: 800;
        }

        .summary-card p {
            margin: 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .history-card {
            overflow: hidden;
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 16px;
        }

        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 22px 24px;
            border-bottom: 1px solid var(--border-soft);
        }

        .history-header h4 {
            margin: 0 0 6px;
            color: var(--sage-dark);
            font-size: 17px;
            font-weight: 750;
        }

        .history-header p {
            margin: 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .history-count {
            padding: 7px 12px;
            border-radius: 20px;
            background: var(--sage-light);
            color: var(--sage-dark);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .examination-table {
            min-width: 1000px;
            margin: 0;
        }

        .examination-table thead th {
            padding: 14px 16px;
            background: #f8f9f5;
            border-top: 0;
            border-bottom: 1px solid var(--border-soft);
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .examination-table tbody td {
            padding: 17px 16px;
            border-top: 1px solid #f0f1ec;
            color: var(--text-main);
            font-size: 12px;
            vertical-align: middle;
        }

        .doctor-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 155px;
            font-weight: 650;
        }

        .doctor-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            border-radius: 11px;
            background: var(--sage-light);
            color: var(--sage);
            font-size: 14px;
        }

        .notes-cell {
            min-width: 160px;
            max-width: 240px;
            line-height: 1.7;
            white-space: normal;
        }

        .medicine-item {
            display: block;
            margin: 3px 0;
            color: var(--sage-dark);
        }

        .muted-text {
            color: var(--text-muted);
        }

        .cost-cell {
            font-weight: 750;
            white-space: nowrap;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-complete {
            background: #e7f5eb;
            color: #267548;
        }

        .status-pending {
            background: #fff3d8;
            color: #946300;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 76px;
            height: 76px;
            margin: 0 auto 20px;
            border-radius: 23px;
            background: var(--sage-light);
            color: var(--sage);
            font-size: 29px;
        }

        .empty-state h5 {
            margin-bottom: 10px;
            color: var(--sage-dark);
            font-size: 18px;
            font-weight: 750;
        }

        .empty-state p {
            max-width: 440px;
            margin: 0 auto 22px;
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .btn-poli {
            display: inline-flex;
            align-items: center;
            padding: 11px 17px;
            border-radius: 10px;
            background: var(--sage);
            color: white;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background .2s ease;
        }

        .btn-poli:hover {
            background: var(--sage-dark);
            color: white;
            text-decoration: none;
        }

        @media (max-width: 767px) {
            .page-heading {
                padding: 22px 20px;
            }

            .page-heading h2 {
                font-size: 22px;
            }

            .heading-icon {
                width: 52px;
                height: 52px;
                border-radius: 15px;
                font-size: 21px;
            }

            .history-header {
                align-items: flex-start;
                padding: 18px;
            }

            .history-header p {
                line-height: 1.6;
            }

            .summary-card {
                padding: 18px;
            }
        }
    </style>
@endpush
