@extends('layouts.app')

@section('subtitle', 'Dashboard Pasien')
@section('content_header_title', 'Dashboard')

@section('content_body')
    <div class="patient-dashboard-page">

        {{-- Sambutan utama --}}
        <section class="patient-welcome">
            <div class="welcome-content">
                <span class="welcome-eyebrow">
                    <i class="fas fa-heartbeat mr-1"></i>
                    SISMENKES · LAYANAN PASIEN
                </span>

                <h1>Selamat Datang,<br>{{ Auth::user()->name }}!</h1>

                <p>
                    Pantau pendaftaran dan temukan jadwal pemeriksaan
                    yang sesuai dengan kebutuhan kesehatan Anda.
                </p>

                @if (Route::has('pasien.daftar-poli.index'))
                    <a href="{{ route('pasien.daftar-poli.index') }}" class="welcome-button">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Daftar Pemeriksaan
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                @elseif (Route::has('pasien.pendaftaran.index'))
                    <a href="{{ route('pasien.pendaftaran.index') }}" class="welcome-button">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Daftar Pemeriksaan
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                @endif
            </div>

            <div class="welcome-illustration" aria-hidden="true">
                <div class="illustration-circle circle-one"></div>
                <div class="illustration-circle circle-two"></div>
                <div class="medical-illustration-card">
                    <i class="fas fa-heartbeat"></i>
                    <span>Health & Care</span>
                    <div class="heartbeat-line">
                        <svg viewBox="0 0 220 45" role="img" aria-label="Ilustrasi detak jantung">
                            <polyline points="0,24 45,24 62,24 76,8 90,38 106,3 121,24 148,24 164,24 176,14 187,24 220,24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="floating-medical-icon">
                    <i class="fas fa-plus"></i>
                </div>
            </div>
        </section>

        {{-- Judul statistik --}}
        <div class="dashboard-section-heading">
            <div>
                <span class="section-eyebrow">RINGKASAN AKUN</span>
                <h4>Informasi Pendaftaran</h4>
                <p>Ringkasan aktivitas layanan kesehatan Anda.</p>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="row patient-statistics">
            <div class="col-sm-6 col-xl-3 mb-3">
                <div class="patient-stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon stat-icon-green">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <span class="stat-label">PENDAFTARAN</span>
                    </div>
                    <div class="stat-value">{{ $jumlahPendaftaran }}</div>
                    <div class="stat-description">Total pendaftaran Anda</div>
                    <div class="stat-bottom-line line-green"></div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3 mb-3">
                <div class="patient-stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon stat-icon-blue">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <span class="stat-label">JADWAL AKTIF</span>
                    </div>
                    <div class="stat-value">{{ $jumlahJadwal }}</div>
                    <div class="stat-description">Jadwal dokter berstatus aktif</div>
                    <div class="stat-bottom-line line-blue"></div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3 mb-3">
                <div class="patient-stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon stat-icon-gold">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <span class="stat-label">LAYANAN POLI</span>
                    </div>
                    <div class="stat-value">{{ $jumlahPoli }}</div>
                    <div class="stat-description">Poli yang tersedia</div>
                    <div class="stat-bottom-line line-gold"></div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3 mb-3">
                <div class="patient-stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon stat-icon-olive">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <span class="stat-label">KUNJUNGAN</span>
                    </div>
                    <div class="stat-value">{{ $pendaftaranAktif }}</div>
                    <div class="stat-description">Pendaftaran hari ini dan mendatang</div>
                    <div class="stat-bottom-line line-olive"></div>
                </div>
            </div>
        </div>

        {{-- Akses cepat --}}
        <div class="dashboard-section-heading quick-access-heading">
            <div>
                <span class="section-eyebrow">AKSES CEPAT</span>
                <h4>Apa yang ingin Anda lakukan?</h4>
                <p>Pilih layanan untuk melanjutkan aktivitas Anda.</p>
            </div>
        </div>

        <div class="row">
            @if (Route::has('pasien.daftar-poli.index'))
                <div class="col-md-6 col-xl-4 mb-3">
                    <a href="{{ route('pasien.daftar-poli.index') }}" class="quick-access-card">
                        <div class="quick-access-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="quick-access-content">
                            <h5>Daftar Pemeriksaan</h5>
                            <p>Lakukan pendaftaran untuk kunjungan pemeriksaan.</p>
                            <span class="quick-access-link">
                                Buka layanan <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </a>
                </div>
            @elseif (Route::has('pasien.pendaftaran.index'))
                <div class="col-md-6 col-xl-4 mb-3">
                    <a href="{{ route('pasien.pendaftaran.index') }}" class="quick-access-card">
                        <div class="quick-access-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="quick-access-content">
                            <h5>Daftar Pemeriksaan</h5>
                            <p>Lakukan pendaftaran untuk kunjungan pemeriksaan.</p>
                            <span class="quick-access-link">
                                Buka layanan <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </a>
                </div>
            @endif

            @if (Route::has('pasien.jadwal.index'))
                <div class="col-md-6 col-xl-4 mb-3">
                    <a href="{{ route('pasien.jadwal.index') }}" class="quick-access-card">
                        <div class="quick-access-icon quick-icon-blue">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="quick-access-content">
                            <h5>Lihat Jadwal Dokter</h5>
                            <p>Periksa jadwal dokter yang tersedia di klinik.</p>
                            <span class="quick-access-link">
                                Lihat jadwal <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </a>
                </div>
            @endif

            @if (Route::has('pasien.profil.edit'))
                <div class="col-md-6 col-xl-4 mb-3">
                    <a href="{{ route('pasien.profil.edit') }}" class="quick-access-card">
                        <div class="quick-access-icon quick-icon-gold">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="quick-access-content">
                            <h5>Profil Saya</h5>
                            <p>Periksa dan perbarui informasi akun Anda.</p>
                            <span class="quick-access-link">
                                Kelola profil <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </a>
                </div>
            @endif
        </div>

        {{-- Informasi --}}
        <div class="patient-information-banner">
            <div class="information-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div>
                <h6>Informasi untuk Pasien</h6>
                <p>
                    Pastikan data pribadi Anda selalu benar dan periksa jadwal
                    kunjungan sebelum datang ke klinik.
                </p>
            </div>
        </div>
    </div>
@stop

@push('css')
    <style>
        /* Hilangkan sidebar khusus halaman dashboard pasien */
        body.patient-no-sidebar .main-sidebar {
            display: none !important;
        }

        body.patient-no-sidebar .main-header,
        body.patient-no-sidebar .content-wrapper,
        body.patient-no-sidebar .main-footer {
            margin-left: 0 !important;
        }

        body.patient-no-sidebar.sidebar-mini .main-header,
        body.patient-no-sidebar.sidebar-mini .content-wrapper,
        body.patient-no-sidebar.sidebar-mini .main-footer {
            margin-left: 0 !important;
        }

        body.patient-no-sidebar .content-wrapper {
            min-height: calc(100vh - 100px);
            background: #f7f7f1;
        }

        body.patient-no-sidebar .content-header {
            padding: 15px 25px 0;
        }

        body.patient-no-sidebar .content {
            padding: 10px 25px 30px;
        }

        .patient-dashboard-page {
            color: #29372f;
        }

        .patient-welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            min-height: 265px;
            overflow: hidden;
            padding: 35px 42px;
            margin-bottom: 31px;
            border-radius: 20px;
            background: linear-gradient(115deg, #253b33 0%, #304b40 58%, #52796f 100%);
            color: #fff;
            box-shadow: 0 12px 30px rgba(37, 59, 51, .13);
        }

        .patient-welcome::before {
            content: "";
            position: absolute;
            width: 340px;
            height: 340px;
            top: -190px;
            right: 12%;
            border: 1px solid rgba(255, 255, 255, .09);
            border-radius: 50%;
        }

        .patient-welcome::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            bottom: -190px;
            left: 35%;
            border: 40px solid rgba(255, 255, 255, .035);
            border-radius: 50%;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            max-width: 580px;
        }

        .welcome-eyebrow {
            display: inline-block;
            margin-bottom: 17px;
            color: #c5d5c5;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .welcome-content h1 {
            margin: 0 0 13px;
            font-size: 31px;
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -.6px;
        }

        .welcome-content p {
            max-width: 460px;
            margin-bottom: 22px;
            color: #dce7dd;
            font-size: 13px;
            line-height: 1.8;
        }

        .welcome-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 17px;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 9px;
            background: #f7f7f1;
            color: #304b40;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
            transition: transform .2s, background .2s;
        }

        .welcome-button:hover {
            transform: translateY(-2px);
            background: #e8efe7;
            color: #253b33;
            text-decoration: none;
        }

        .welcome-illustration {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 290px;
            height: 220px;
            flex-shrink: 0;
            margin-left: 20px;
        }

        .illustration-circle {
            position: absolute;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 50%;
        }

        .circle-one {
            width: 220px;
            height: 220px;
        }

        .circle-two {
            width: 165px;
            height: 165px;
            background: rgba(255, 255, 255, .035);
        }

        .medical-illustration-card {
            position: relative;
            z-index: 1;
            width: 205px;
            padding: 19px 17px 12px;
            border: 1px solid rgba(255, 255, 255, .23);
            border-radius: 18px;
            background: rgba(255, 255, 255, .12);
            box-shadow: 0 15px 35px rgba(20, 40, 30, .13);
            backdrop-filter: blur(8px);
        }

        .medical-illustration-card>i {
            display: block;
            margin-bottom: 8px;
            color: #d8e8d7;
            font-size: 30px;
        }

        .medical-illustration-card>span {
            color: #fff;
            font-size: 12px;
            font-weight: 750;
        }

        .heartbeat-line {
            margin-top: 12px;
            color: #c5d5c5;
        }

        .heartbeat-line svg {
            display: block;
            width: 100%;
        }

        .floating-medical-icon {
            position: absolute;
            z-index: 2;
            top: 22px;
            right: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            border: 4px solid #52796f;
            border-radius: 14px;
            background: #f7f7f1;
            color: #52796f;
            font-size: 17px;
        }

        .dashboard-section-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 17px;
        }

        .section-eyebrow {
            color: #688f80;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.4px;
        }

        .dashboard-section-heading h4 {
            margin: 5px 0 5px;
            color: #253b33;
            font-size: 19px;
            font-weight: 800;
        }

        .dashboard-section-heading p {
            margin: 0;
            color: #7b877e;
            font-size: 12px;
        }

        .patient-statistics {
            margin-bottom: 19px;
        }

        .patient-stat-card {
            position: relative;
            height: 100%;
            min-height: 165px;
            overflow: hidden;
            padding: 20px;
            border: 1px solid #e6e9e1;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 16px rgba(37, 59, 51, .035);
            transition: transform .2s, box-shadow .2s;
        }

        .patient-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(37, 59, 51, .07);
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 15px;
        }

        .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            border-radius: 13px;
            font-size: 17px;
        }

        .stat-icon-green {
            background: #e8efe7;
            color: #52796f;
        }

        .stat-icon-blue {
            background: #e9f0f1;
            color: #5b8186;
        }

        .stat-icon-gold {
            background: #f3f0e5;
            color: #9b8755;
        }

        .stat-icon-olive {
            background: #edf1e5;
            color: #798c5c;
        }

        .stat-label {
            color: #8a948b;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .7px;
            text-align: right;
        }

        .stat-value {
            color: #253b33;
            font-size: 29px;
            font-weight: 800;
            line-height: 1.15;
        }

        .stat-description {
            margin-top: 6px;
            color: #7b877e;
            font-size: 11px;
            line-height: 1.5;
        }

        .stat-bottom-line {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 3px;
        }

        .line-green {
            background: #84a98c;
        }

        .line-blue {
            background: #8aafb2;
        }

        .line-gold {
            background: #c7b785;
        }

        .line-olive {
            background: #a8b98a;
        }

        .quick-access-heading {
            margin-top: 9px;
        }

        .quick-access-card {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            height: 100%;
            min-height: 145px;
            padding: 22px;
            border: 1px solid #e6e9e1;
            border-radius: 15px;
            background: #fff;
            color: inherit;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(37, 59, 51, .035);
            transition: transform .2s, border-color .2s, box-shadow .2s;
        }

        .quick-access-card:hover {
            transform: translateY(-3px);
            border-color: #c5d5c5;
            box-shadow: 0 10px 24px rgba(37, 59, 51, .065);
            color: inherit;
            text-decoration: none;
        }

        .quick-access-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            border-radius: 13px;
            background: #e8efe7;
            color: #52796f;
            font-size: 18px;
        }

        .quick-icon-blue {
            background: #e9f0f1;
            color: #5b8186;
        }

        .quick-icon-gold {
            background: #f3f0e5;
            color: #9b8755;
        }

        .quick-access-content {
            min-width: 0;
        }

        .quick-access-content h5 {
            margin: 2px 0 8px;
            color: #304b40;
            font-size: 13px;
            font-weight: 800;
        }

        .quick-access-content p {
            min-height: 34px;
            margin-bottom: 11px;
            color: #7b877e;
            font-size: 11px;
            line-height: 1.6;
        }

        .quick-access-link {
            color: #52796f;
            font-size: 10px;
            font-weight: 800;
        }

        .patient-information-banner {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 17px 20px;
            margin-top: 8px;
            border: 1px solid #e0e8dc;
            border-radius: 13px;
            background: #eef3eb;
        }

        .information-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            border-radius: 10px;
            background: #dce8d9;
            color: #52796f;
        }

        .patient-information-banner h6 {
            margin: 1px 0 5px;
            color: #304b40;
            font-size: 12px;
            font-weight: 800;
        }

        .patient-information-banner p {
            margin: 0;
            color: #68796c;
            font-size: 11px;
            line-height: 1.7;
        }

        @media (max-width: 767px) {
            body.patient-no-sidebar .content-header {
                padding-right: 15px;
                padding-left: 15px;
            }

            body.patient-no-sidebar .content {
                padding-right: 15px;
                padding-left: 15px;
            }

            .patient-welcome {
                min-height: auto;
                padding: 27px 24px;
            }

            .welcome-content h1 {
                font-size: 25px;
            }

            .welcome-illustration {
                display: none;
            }

            .dashboard-section-heading h4 {
                font-size: 17px;
            }

            .patient-stat-card {
                min-height: 150px;
                padding: 17px;
            }

            .quick-access-card {
                min-height: auto;
                padding: 18px;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('patient-no-sidebar');
        });
    </script>
@endpush
