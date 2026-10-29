@extends('layouts.app')

@section('subtitle', 'Dashboard Admin')

@section('content_header_title', 'Dashboard')

@section('content_header_subtitle', 'Ringkasan Klinik')

@section('content_body')

    <div class="clinic-dashboard">

        {{-- Sambutan --}}
        <div class="dashboard-welcome mb-4">
            <div>
                <div class="welcome-eyebrow">
                    SISTEM INFORMASI MANAJEMEN KESEHATAN
                </div>

                <h2>Selamat datang, Admin!</h2>

                <p>
                    Pantau data klinik dan aktivitas pelayanan kesehatan
                    melalui ringkasan berikut.
                </p>
            </div>

            <div class="welcome-date">
                <i class="far fa-calendar-alt"></i>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        {{-- Statistik utama --}}
        <div class="dashboard-section-heading">
            <div>
                <h5>Ringkasan Data</h5>
                <p>Informasi utama yang tercatat dalam sistem.</p>
            </div>
        </div>

        <div class="row">

            {{-- Dokter --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon sage">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <span class="stat-label">TENAGA MEDIS</span>
                    </div>

                    <div class="stat-value">{{ $jumlahDokter }}</div>
                    <div class="stat-title">Total Dokter</div>

                    <a href="{{ route('admin.dokter.index') }}" class="stat-link">
                        Lihat data dokter
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Pasien --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon olive">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="stat-label">PASIEN</span>
                    </div>

                    <div class="stat-value">{{ $jumlahPasien }}</div>
                    <div class="stat-title">Total Pasien</div>

                    <a href="{{ route('admin.pasien.index') }}" class="stat-link">
                        Lihat data pasien
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Poli --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon cream">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <span class="stat-label">PELAYANAN</span>
                    </div>

                    <div class="stat-value">{{ $jumlahPoli }}</div>
                    <div class="stat-title">Total Poli</div>

                    <a href="{{ route('admin.poli.index') }}" class="stat-link">
                        Lihat data poli
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Obat --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon mint">
                            <i class="fas fa-pills"></i>
                        </div>
                        <span class="stat-label">FARMASI</span>
                    </div>

                    <div class="stat-value">{{ $jumlahObat }}</div>
                    <div class="stat-title">Jenis Obat</div>

                    <a href="{{ route('admin.obat.index') }}" class="stat-link">
                        Lihat data obat
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- Statistik operasional --}}
        <div class="dashboard-section-heading mt-4">
            <div>
                <h5>Aktivitas Pelayanan</h5>
                <p>Ringkasan pendaftaran dan pemeriksaan pasien.</p>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-md-4">
                <div class="activity-card">
                    <div class="activity-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>

                    <div class="activity-content">
                        <span>Pendaftaran Hari Ini</span>
                        <strong>{{ $jumlahPendaftaranHariIni }}</strong>
                        <small>Total pendaftaran dengan tanggal kunjungan hari ini</small>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="activity-card">
                    <div class="activity-icon completed">
                        <i class="fas fa-stethoscope"></i>
                    </div>

                    <div class="activity-content">
                        <span>Pemeriksaan Hari Ini</span>
                        <strong>{{ $jumlahPemeriksaanHariIni }}</strong>
                        <small>Total catatan pemeriksaan bertanggal hari ini</small>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="activity-card">
                    <div class="activity-icon pending">
                        <i class="fas fa-hourglass-half"></i>
                    </div>

                    <div class="activity-content">
                        <span>Belum Diperiksa</span>
                        <strong>{{ $jumlahBelumDiperiksa }}</strong>
                        <small>Pendaftaran yang belum memiliki catatan pemeriksaan</small>
                    </div>
                </div>
            </div>

        </div>

        {{-- Pendaftaran terbaru --}}
        <div class="dashboard-section-heading mt-4">
            <div>
                <h5>Pendaftaran Terbaru</h5>
                <p>Lima data pendaftaran terakhir yang tercatat.</p>
            </div>

            <a href="{{ route('admin.pasien.index') }}" class="btn-dashboard-link">
                Data pasien
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="dashboard-table-card">
            <div class="table-responsive">
                <table class="table dashboard-table mb-0">
                    <thead>
                        <tr>
                            <th>No. Antrean</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pendaftaranTerbaru as $pendaftaran)
                            <tr>
                                <td>
                                    <span class="queue-number">
                                        {{ $pendaftaran->no_antrian ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="patient-name">
                                        {{ $pendaftaran->pasien->nama ?? ($pendaftaran->pasien->name ?? 'Pasien tidak ditemukan') }}
                                    </div>
                                </td>

                                <td>
                                    {{ $pendaftaran->jadwal?->dokter?->nama ?? ($pendaftaran->jadwal?->dokter?->name ?? '-') }}
                                </td>

                                <td>
                                    {{ $pendaftaran->tanggal_kunjungan
                                        ? \Illuminate\Support\Carbon::parse($pendaftaran->tanggal_kunjungan)->format('d/m/Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="complaint-text">
                                        {{ \Illuminate\Support\Str::limit($pendaftaran->keluhan ?? '-', 35) }}
                                    </span>
                                </td>

                                <td>
                                    @if ($pendaftaran->periksa)
                                        <span class="status-pill status-completed">
                                            <i class="fas fa-check-circle"></i>
                                            Sudah diperiksa
                                        </span>
                                    @else
                                        <span class="status-pill status-pending">
                                            <i class="fas fa-clock"></i>
                                            Menunggu
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>

                                    <strong>Belum ada pendaftaran</strong>

                                    <p>Data pendaftaran akan muncul di sini setelah tersedia.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Akses cepat --}}
        <div class="dashboard-section-heading mt-4">
            <div>
                <h5>Akses Cepat</h5>
                <p>Buka modul pengelolaan yang sering digunakan.</p>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-sm-6 col-lg-3">
                <a href="{{ route('admin.dokter.index') }}" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div>
                        <strong>Kelola Dokter</strong>
                        <span>Data tenaga medis</span>
                    </div>
                    <i class="fas fa-chevron-right quick-arrow"></i>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <a href="{{ route('admin.pasien.index') }}" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <strong>Kelola Pasien</strong>
                        <span>Data pasien klinik</span>
                    </div>
                    <i class="fas fa-chevron-right quick-arrow"></i>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <a href="{{ route('admin.poli.index') }}" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <div>
                        <strong>Kelola Poli</strong>
                        <span>Unit pelayanan</span>
                    </div>
                    <i class="fas fa-chevron-right quick-arrow"></i>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <a href="{{ route('admin.obat.index') }}" class="quick-action">
                    <div class="quick-action-icon">
                        <i class="fas fa-pills"></i>
                    </div>
                    <div>
                        <strong>Kelola Obat</strong>
                        <span>Data persediaan obat</span>
                    </div>
                    <i class="fas fa-chevron-right quick-arrow"></i>
                </a>
            </div>

        </div>

    </div>

@stop

@push('css')
    <style>
        .clinic-dashboard {
            color: #29372f;
        }

        .clinic-dashboard .dashboard-welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 26px 28px;
            border: 1px solid #e1e9df;
            border-radius: 16px;
            background: linear-gradient(120deg, #eef3eb 0%, #f7f7f1 72%);
        }

        .welcome-eyebrow {
            margin-bottom: 8px;
            color: #688f80;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.6px;
        }

        .dashboard-welcome h2 {
            margin: 0 0 8px;
            color: #304b40;
            font-size: 25px;
            font-weight: 750;
        }

        .dashboard-welcome p {
            margin: 0;
            color: #718076;
            font-size: 13px;
        }

        .welcome-date {
            flex-shrink: 0;
            padding: 11px 14px;
            border: 1px solid #dce5d9;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.75);
            color: #52796f;
            font-size: 12px;
            font-weight: 600;
        }

        .welcome-date i {
            margin-right: 6px;
        }

        .dashboard-section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .dashboard-section-heading h5 {
            margin: 0 0 5px;
            color: #304b40;
            font-size: 16px;
            font-weight: 750;
        }

        .dashboard-section-heading p {
            margin: 0;
            color: #879187;
            font-size: 12px;
        }

        .stat-card {
            height: calc(100% - 20px);
            min-height: 185px;
            margin-bottom: 20px;
            padding: 19px;
            border: 1px solid #e7ebe4;
            border-radius: 14px;
            background: #ffffff;
            box-shadow: 0 3px 12px rgba(37, 59, 51, 0.035);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(37, 59, 51, 0.08);
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .stat-icon {
            display: flex;
            width: 43px;
            height: 43px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 17px;
        }

        .stat-icon.sage {
            background: #e6efe5;
            color: #52796f;
        }

        .stat-icon.olive {
            background: #eef0dc;
            color: #7c8554;
        }

        .stat-icon.cream {
            background: #f6eee0;
            color: #a37f45;
        }

        .stat-icon.mint {
            background: #e3f1e9;
            color: #4f896d;
        }

        .stat-label {
            color: #a0a99f;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .stat-value {
            margin-top: 17px;
            color: #304b40;
            font-size: 30px;
            font-weight: 800;
            line-height: 1.1;
        }

        .stat-title {
            margin-top: 5px;
            color: #6f7d72;
            font-size: 12px;
        }

        .stat-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 11px;
            border-top: 1px solid #eff1eb;
            color: #688f80;
            font-size: 11px;
            font-weight: 700;
        }

        .stat-link:hover {
            color: #304b40;
            text-decoration: none;
        }

        .activity-card {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            height: calc(100% - 15px);
            min-height: 135px;
            margin-bottom: 15px;
            padding: 18px;
            border: 1px solid #e7ebe4;
            border-radius: 13px;
            background: #ffffff;
        }

        .activity-icon {
            display: flex;
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #e6efe5;
            color: #52796f;
        }

        .activity-icon.completed {
            background: #e2f1e7;
            color: #43805e;
        }

        .activity-icon.pending {
            background: #f7efdf;
            color: #a17a37;
        }

        .activity-content {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .activity-content span {
            color: #748075;
            font-size: 11px;
            font-weight: 600;
        }

        .activity-content strong {
            margin: 6px 0;
            color: #304b40;
            font-size: 25px;
            line-height: 1.1;
        }

        .activity-content small {
            color: #9aa398;
            font-size: 10px;
            line-height: 1.5;
        }

        .dashboard-table-card {
            overflow: hidden;
            border: 1px solid #e7ebe4;
            border-radius: 13px;
            background: #ffffff;
            box-shadow: 0 3px 12px rgba(37, 59, 51, 0.025);
        }

        .dashboard-table {
            min-width: 850px;
        }

        .dashboard-table thead th {
            padding: 14px 15px;
            border-top: 0;
            border-bottom: 1px solid #e8ece5;
            background: #f5f7f1;
            color: #718076;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.35px;
            white-space: nowrap;
        }

        .dashboard-table tbody td {
            padding: 15px;
            border-top: 1px solid #f0f2ed;
            color: #59675c;
            font-size: 11px;
            vertical-align: middle;
        }

        .dashboard-table tbody tr:hover {
            background: #fafbf8;
        }

        .queue-number {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 6px;
            background: #edf2e9;
            color: #52796f;
            font-size: 10px;
            font-weight: 800;
        }

        .patient-name {
            color: #304b40;
            font-weight: 700;
        }

        .complaint-text {
            display: inline-block;
            max-width: 180px;
            color: #7d887e;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-completed {
            background: #e5f2e8;
            color: #427a55;
        }

        .status-pending {
            background: #f8f0df;
            color: #9b7739;
        }

        .empty-state {
            padding: 35px 15px !important;
            text-align: center;
        }

        .empty-state-icon {
            margin-bottom: 10px;
            color: #a8b8a8;
            font-size: 25px;
        }

        .empty-state strong {
            display: block;
            color: #52796f;
            font-size: 13px;
        }

        .empty-state p {
            margin: 6px 0 0;
            color: #98a198;
            font-size: 11px;
        }

        .btn-dashboard-link {
            padding: 8px 12px;
            border: 1px solid #dce6d9;
            border-radius: 8px;
            background: #ffffff;
            color: #52796f;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .btn-dashboard-link:hover {
            border-color: #b8cdb8;
            background: #f3f7f0;
            color: #304b40;
            text-decoration: none;
        }

        .quick-action {
            display: flex;
            align-items: center;
            gap: 11px;
            height: calc(100% - 15px);
            min-height: 82px;
            margin-bottom: 15px;
            padding: 14px;
            border: 1px solid #e7ebe4;
            border-radius: 12px;
            background: #ffffff;
            color: #304b40;
            transition: border-color 0.2s ease, transform 0.2s ease;
        }

        .quick-action:hover {
            transform: translateY(-2px);
            border-color: #b8cdb8;
            color: #304b40;
            text-decoration: none;
        }

        .quick-action-icon {
            display: flex;
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #e9f0e6;
            color: #52796f;
        }

        .quick-action strong,
        .quick-action span {
            display: block;
        }

        .quick-action strong {
            font-size: 11px;
            font-weight: 750;
        }

        .quick-action span {
            margin-top: 4px;
            color: #929c91;
            font-size: 10px;
        }

        .quick-arrow {
            margin-left: auto;
            color: #a4b2a3;
            font-size: 10px;
        }

        @media (max-width: 767.98px) {
            .clinic-dashboard .dashboard-welcome {
                align-items: flex-start;
                flex-direction: column;
                padding: 21px;
            }

            .dashboard-welcome h2 {
                font-size: 22px;
            }

            .welcome-date {
                font-size: 11px;
            }

            .stat-card {
                min-height: 170px;
            }
        }

        /* ========================================
           DASHBOARD REFINEMENT
           Sage Green & Warm Ivory
        ======================================== */

        .clinic-dashboard {
            color: #29372f;
            font-size: 14px;
        }

        /* Sambutan */
        .clinic-dashboard .dashboard-welcome {
            padding: 30px 32px;
            border: 1px solid #d8e4d6;
            border-left: 5px solid #52796f;
            border-radius: 16px;
            background: linear-gradient(115deg, #e8efe7 0%, #fdfdf9 100%);
        }

        .clinic-dashboard .welcome-eyebrow {
            color: #52796f;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.3px;
        }

        .clinic-dashboard .dashboard-welcome h2 {
            margin-bottom: 10px;
            color: #253b33;
            font-size: 30px;
            font-weight: 800;
            line-height: 1.3;
        }

        .clinic-dashboard .dashboard-welcome p {
            color: #526257;
            font-size: 14px;
            line-height: 1.7;
        }

        .clinic-dashboard .welcome-date {
            padding: 12px 15px;
            border-color: #cbdacb;
            color: #304b40;
            font-size: 13px;
            font-weight: 700;
        }

        /* Judul setiap bagian */
        .clinic-dashboard .dashboard-section-heading {
            margin-bottom: 18px;
        }

        .clinic-dashboard .dashboard-section-heading h5 {
            color: #253b33;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -0.25px;
        }

        .clinic-dashboard .dashboard-section-heading p {
            color: #657468;
            font-size: 13px;
            line-height: 1.6;
        }

        /* Kartu statistik */
        .clinic-dashboard .stat-card {
            min-height: 205px;
            padding: 22px;
            border: 1px solid #dfe7dc;
            border-radius: 15px;
            box-shadow: 0 4px 14px rgba(37, 59, 51, 0.055);
        }

        .clinic-dashboard .stat-card:hover {
            border-color: #b4cbb6;
            box-shadow: 0 10px 24px rgba(37, 59, 51, 0.09);
        }

        .clinic-dashboard .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            font-size: 19px;
        }

        .clinic-dashboard .stat-label {
            color: #687a6b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.8px;
        }

        .clinic-dashboard .stat-value {
            margin-top: 19px;
            color: #253b33;
            font-size: 38px;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .clinic-dashboard .stat-title {
            margin-top: 7px;
            color: #46594b;
            font-size: 14px;
            font-weight: 600;
        }

        .clinic-dashboard .stat-link {
            margin-top: 17px;
            padding-top: 13px;
            border-color: #e3e9df;
            color: #426b59;
            font-size: 12px;
            font-weight: 700;
        }

        /* Kartu aktivitas */
        .clinic-dashboard .activity-card {
            min-height: 150px;
            padding: 22px;
            border: 1px solid #dfe7dc;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(37, 59, 51, 0.035);
        }

        .clinic-dashboard .activity-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            font-size: 17px;
        }

        .clinic-dashboard .activity-content span {
            color: #526257;
            font-size: 13px;
            font-weight: 700;
        }

        .clinic-dashboard .activity-content strong {
            margin: 8px 0;
            color: #253b33;
            font-size: 32px;
            font-weight: 800;
        }

        .clinic-dashboard .activity-content small {
            color: #657468;
            font-size: 12px;
            line-height: 1.6;
        }

        /* Tabel pendaftaran */
        .clinic-dashboard .dashboard-table thead th {
            padding: 16px;
            background: #e8efe7;
            color: #304b40;
            font-size: 12px;
            font-weight: 800;
        }

        .clinic-dashboard .dashboard-table tbody td {
            padding: 16px;
            color: #46564a;
            font-size: 13px;
        }

        .clinic-dashboard .patient-name {
            color: #253b33;
            font-size: 13px;
            font-weight: 700;
        }

        .clinic-dashboard .complaint-text {
            color: #526257;
            font-size: 12px;
        }

        .clinic-dashboard .status-pill {
            padding: 7px 10px;
            font-size: 11px;
            font-weight: 700;
        }

        /* Akses cepat */
        .clinic-dashboard .quick-action {
            min-height: 90px;
            padding: 16px;
            border-color: #dfe7dc;
        }

        .clinic-dashboard .quick-action-icon {
            width: 44px;
            height: 44px;
            font-size: 16px;
        }

        .clinic-dashboard .quick-action strong {
            color: #304b40;
            font-size: 13px;
        }

        .clinic-dashboard .quick-action span {
            color: #657468;
            font-size: 12px;
        }

        /* Tombol dan keadaan kosong */
        .clinic-dashboard .btn-dashboard-link {
            color: #304b40;
            font-size: 12px;
            font-weight: 700;
        }

        .clinic-dashboard .empty-state strong {
            color: #304b40;
            font-size: 14px;
        }

        .clinic-dashboard .empty-state p {
            color: #657468;
            font-size: 12px;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 767.98px) {
            .clinic-dashboard .dashboard-welcome {
                padding: 22px;
            }

            .clinic-dashboard .dashboard-welcome h2 {
                font-size: 25px;
            }

            .clinic-dashboard .dashboard-section-heading h5 {
                font-size: 17px;
            }

            .clinic-dashboard .stat-value {
                font-size: 34px;
            }
        }
    </style>
@endpush
