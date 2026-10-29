@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
    <style>
        .doctor-dashboard {
            color: #29372f;
            font-size: 14px;
        }

        .doctor-dashboard .welcome-panel {
            position: relative;
            overflow: hidden;
            padding: 30px;
            border-radius: 18px;
            color: #fff;
            background: linear-gradient(120deg, #304b40 0%, #52796f 65%, #688f80 100%);
            box-shadow: 0 8px 24px rgba(37, 59, 51, .13);
        }

        .doctor-dashboard .welcome-panel::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            right: -65px;
            top: -100px;
            border: 35px solid rgba(255, 255, 255, .08);
            border-radius: 50%;
            pointer-events: none;
        }

        .doctor-dashboard .welcome-panel::before {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            right: 70px;
            bottom: -110px;
            background: rgba(255, 255, 255, .07);
            border-radius: 50%;
            pointer-events: none;
        }

        .doctor-dashboard .welcome-content {
            position: relative;
            z-index: 1;
        }

        .doctor-dashboard .eyebrow {
            margin-bottom: 8px;
            color: #dce9df;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .doctor-dashboard .welcome-title {
            margin: 0 0 10px;
            font-size: 28px;
            line-height: 1.35;
            font-weight: 750;
        }

        .doctor-dashboard .welcome-description {
            max-width: 600px;
            margin: 0;
            color: #edf4ee;
            font-size: 14px;
            line-height: 1.8;
        }

        .doctor-dashboard .date-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 9px 13px;
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 10px;
            background: rgba(255, 255, 255, .1);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .doctor-dashboard .section-heading {
            margin-bottom: 16px;
        }

        .doctor-dashboard .section-title {
            margin: 0 0 5px;
            color: #29372f;
            font-size: 18px;
            font-weight: 750;
        }

        .doctor-dashboard .section-description {
            margin: 0;
            color: #7b877e;
            font-size: 13px;
        }

        .doctor-dashboard .stat-card {
            display: flex;
            height: 100%;
            min-height: 145px;
            align-items: flex-start;
            gap: 15px;
            padding: 22px;
            border: 1px solid #e6e9e1;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(41, 55, 47, .035);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .doctor-dashboard .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(41, 55, 47, .08);
        }

        .doctor-dashboard .stat-icon {
            display: flex;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            font-size: 21px;
        }

        .doctor-dashboard .icon-green {
            color: #3d6253;
            background: #e8efe7;
        }

        .doctor-dashboard .icon-blue {
            color: #416b83;
            background: #e8f1f5;
        }

        .doctor-dashboard .icon-orange {
            color: #986b2d;
            background: #faf0dd;
        }

        .doctor-dashboard .icon-purple {
            color: #75619b;
            background: #f0ebf8;
        }

        .doctor-dashboard .stat-label {
            margin: 2px 0 8px;
            color: #68766c;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }

        .doctor-dashboard .stat-value {
            margin: 0;
            color: #29372f;
            font-size: 30px;
            font-weight: 800;
            line-height: 1.2;
        }

        .doctor-dashboard .stat-note {
            display: block;
            margin-top: 8px;
            color: #7b877e;
            font-size: 12px;
        }

        .doctor-dashboard .content-panel {
            height: 100%;
            padding: 23px;
            border: 1px solid #e6e9e1;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(41, 55, 47, .035);
        }

        .doctor-dashboard .panel-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .doctor-dashboard .panel-icon {
            display: flex;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e8efe7;
            color: #3d6253;
            font-size: 18px;
        }

        .doctor-dashboard .panel-title {
            margin: 0 0 4px;
            font-size: 16px;
            font-weight: 750;
            color: #29372f;
        }

        .doctor-dashboard .panel-subtitle {
            margin: 0;
            font-size: 12px;
            color: #7b877e;
        }

        .doctor-dashboard .progress-row {
            margin-bottom: 21px;
        }

        .doctor-dashboard .progress-row:last-child {
            margin-bottom: 0;
        }

        .doctor-dashboard .progress-labels {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 9px;
            font-size: 13px;
        }

        .doctor-dashboard .progress-label {
            color: #536157;
            font-weight: 600;
        }

        .doctor-dashboard .progress-number {
            color: #29372f;
            font-weight: 750;
        }

        .doctor-dashboard .progress-track {
            height: 9px;
            overflow: hidden;
            border-radius: 20px;
            background: #edf0ea;
        }

        .doctor-dashboard .progress-fill {
            height: 100%;
            border-radius: 20px;
            transition: width .3s ease;
        }

        .doctor-dashboard .progress-complete {
            background: #52796f;
        }

        .doctor-dashboard .progress-pending {
            background: #d8a454;
        }

        .doctor-dashboard .quick-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 0;
            color: inherit;
            text-decoration: none !important;
            border-bottom: 1px solid #edf0ea;
            transition: background .2s ease;
        }

        .doctor-dashboard .quick-link:first-of-type {
            padding-top: 0;
        }

        .doctor-dashboard .quick-link:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .doctor-dashboard .quick-link:hover .quick-link-title {
            color: #52796f;
        }

        .doctor-dashboard .quick-link-icon {
            display: flex;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: #3d6253;
            background: #e8efe7;
            font-size: 17px;
        }

        .doctor-dashboard .quick-link-title {
            margin: 0 0 4px;
            color: #29372f;
            font-size: 13px;
            font-weight: 700;
            transition: color .2s ease;
        }

        .doctor-dashboard .quick-link-description {
            margin: 0;
            color: #7b877e;
            font-size: 12px;
        }

        .doctor-dashboard .quick-link-arrow {
            margin-left: auto;
            color: #9aa49b;
            font-size: 14px;
        }

        .doctor-dashboard .footer-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 18px;
            border: 1px solid #dce7dc;
            border-radius: 12px;
            background: #f1f5ef;
            color: #536157;
            font-size: 13px;
            line-height: 1.7;
        }

        .doctor-dashboard .footer-note i {
            margin-top: 3px;
            color: #52796f;
        }

        @media (max-width: 767.98px) {
            .doctor-dashboard .welcome-panel {
                padding: 23px 20px;
            }

            .doctor-dashboard .welcome-title {
                font-size: 23px;
            }

            .doctor-dashboard .stat-card {
                min-height: 125px;
                padding: 17px;
                gap: 12px;
            }

            .doctor-dashboard .stat-icon {
                width: 42px;
                height: 42px;
                font-size: 18px;
            }

            .doctor-dashboard .stat-value {
                font-size: 26px;
            }

            .doctor-dashboard .content-panel {
                padding: 19px;
            }
        }
    </style>

    @php
        $totalPemeriksaan = (int) $sudahDiperiksa + (int) $belumDiperiksa;

        $persentaseSelesai = $totalPemeriksaan > 0 ? round(($sudahDiperiksa / $totalPemeriksaan) * 100) : 0;

        $persentaseBelum = $totalPemeriksaan > 0 ? round(($belumDiperiksa / $totalPemeriksaan) * 100) : 0;

        $namaDokter = auth()->user()->name ?? 'Dokter';
    @endphp

    <div class="doctor-dashboard">
        {{-- Welcome panel --}}
        <div class="welcome-panel mb-4">
            <div class="welcome-content">
                <div class="eyebrow">SISMENKES · Area Dokter</div>

                <h1 class="welcome-title">
                    Selamat datang, {{ $namaDokter }}!
                </h1>

                <p class="welcome-description">
                    Pantau aktivitas pelayanan kesehatan Anda, kelola jadwal praktik,
                    dan lanjutkan pemeriksaan pasien melalui satu halaman.
                </p>

                <div class="date-chip">
                    <i class="far fa-calendar-alt"></i>
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        {{-- Section heading --}}
        <div class="section-heading">
            <h2 class="section-title">Ringkasan Aktivitas</h2>
            <p class="section-description">
                Gambaran umum aktivitas dan data pelayanan Anda.
            </p>
        </div>

        {{-- Statistics --}}
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon icon-green">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <div>
                        <p class="stat-label">Total Pasien</p>
                        <h3 class="stat-value">{{ number_format($totalPasien) }}</h3>
                        <span class="stat-note">Pasien terdaftar pada jadwal Anda</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <p class="stat-label">Pendaftaran Hari Ini</p>
                        <h3 class="stat-value">{{ number_format($pendaftaranHariIni) }}</h3>
                        <span class="stat-note">Pendaftaran pada tanggal hari ini</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon icon-purple">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div>
                        <p class="stat-label">Sudah Diperiksa</p>
                        <h3 class="stat-value">{{ number_format($sudahDiperiksa) }}</h3>
                        <span class="stat-note">Total pemeriksaan tercatat</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon icon-orange">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div>
                        <p class="stat-label">Belum Diperiksa</p>
                        <h3 class="stat-value">{{ number_format($belumDiperiksa) }}</h3>
                        <span class="stat-note">Perkiraan berdasarkan data saat ini</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Activity and quick access --}}
        <div class="row mt-2">
            <div class="col-12 col-lg-7 mb-4">
                <div class="content-panel">
                    <div class="panel-heading">
                        <div class="panel-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div>
                            <h3 class="panel-title">Ringkasan Pemeriksaan</h3>
                            <p class="panel-subtitle">
                                Perbandingan jumlah pemeriksaan yang tercatat
                            </p>
                        </div>
                    </div>

                    <div class="progress-row">
                        <div class="progress-labels">
                            <span class="progress-label">Sudah diperiksa</span>
                            <span class="progress-number">
                                {{ number_format($sudahDiperiksa) }}
                                ({{ $persentaseSelesai }}%)
                            </span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill progress-complete" style="width: {{ $persentaseSelesai }}%;"></div>
                        </div>
                    </div>

                    <div class="progress-row">
                        <div class="progress-labels">
                            <span class="progress-label">Belum diperiksa</span>
                            <span class="progress-number">
                                {{ number_format($belumDiperiksa) }}
                                ({{ $persentaseBelum }}%)
                            </span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill progress-pending" style="width: {{ $persentaseBelum }}%;"></div>
                        </div>
                    </div>

                    <div class="footer-note mt-4">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <strong>Informasi:</strong>
                            ringkasan ini menggunakan statistik yang tersedia saat ini.
                            Jumlah pemeriksaan tidak selalu sama dengan jumlah pasien unik.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5 mb-4">
                <div class="content-panel">
                    <div class="panel-heading">
                        <div class="panel-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h3 class="panel-title">Akses Cepat</h3>
                            <p class="panel-subtitle">
                                Buka fitur yang Anda perlukan
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('memeriksa.index') }}" class="quick-link">
                        <div class="quick-link-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div>
                            <p class="quick-link-title">Pemeriksaan Pasien</p>
                            <p class="quick-link-description">
                                Lihat dan kelola pemeriksaan pasien
                            </p>
                        </div>
                        <i class="fas fa-chevron-right quick-link-arrow"></i>
                    </a>

                    <a href="{{ route('jadwal.index') }}" class="quick-link">
                        <div class="quick-link-icon">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div>
                            <p class="quick-link-title">Jadwal Praktik</p>
                            <p class="quick-link-description">
                                Kelola jadwal praktik Anda
                            </p>
                        </div>
                        <i class="fas fa-chevron-right quick-link-arrow"></i>
                    </a>

                    <a href="{{ route('riwayat.index') }}" class="quick-link">
                        <div class="quick-link-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <p class="quick-link-title">Riwayat Pasien</p>
                            <p class="quick-link-description">
                                Tinjau catatan pemeriksaan sebelumnya
                            </p>
                        </div>
                        <i class="fas fa-chevron-right quick-link-arrow"></i>
                    </a>

                    <a href="{{ route('profil.edit') }}" class="quick-link">
                        <div class="quick-link-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div>
                            <p class="quick-link-title">Profil Dokter</p>
                            <p class="quick-link-description">
                                Lihat dan perbarui profil Anda
                            </p>
                        </div>
                        <i class="fas fa-chevron-right quick-link-arrow"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
