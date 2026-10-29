@extends('adminlte::page')

{{-- Judul halaman --}}
@section('title')
    @hasSection('subtitle')
        @yield('subtitle') |
    @endif

    {{ config('adminlte.title', config('app.name', 'Sistem Informasi Klinik')) }}
@stop


{{-- Navigasi khusus pasien --}}
@if (auth()->check() && auth()->user()->role === 'pasien')
    @section('content_top_nav_left')
        <li class="nav-item clinic-patient-nav-item">
            <a href="{{ route('pasien.dashboard') }}"
                class="nav-link clinic-patient-nav-link {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item clinic-patient-nav-item">
            <a href="{{ route('pasien.poli.index') }}"
                class="nav-link clinic-patient-nav-link {{ request()->routeIs('pasien.poli.*') ? 'active' : '' }}">
                <i class="fas fa-hospital"></i>
                <span>Daftar Poli</span>
            </a>
        </li>

        <li class="nav-item clinic-patient-nav-item">
            <a href="{{ route('pasien.periksa.index') }}"
                class="nav-link clinic-patient-nav-link {{ request()->routeIs('pasien.periksa.*') ? 'active' : '' }}">
                <i class="fas fa-notes-medical"></i>
                <span>Periksa</span>
            </a>
        </li>
    @stop
@endif


{{-- Header konten --}}
@section('content_header')
    @hasSection('content_header_title')
        <div class="clinic-page-heading">
            <div class="clinic-page-heading__main">
                <span class="clinic-page-eyebrow">
                    SISTEM INFORMASI KLINIK
                </span>

                <h1 class="clinic-page-title">
                    @yield('content_header_title')

                    @hasSection('content_header_subtitle')
                        <span class="clinic-page-subtitle">
                            <i class="fas fa-chevron-right"></i>
                            @yield('content_header_subtitle')
                        </span>
                    @endif
                </h1>
            </div>
        </div>
    @endif
@stop

{{-- Isi konten --}}
@section('content')
    <div class="clinic-content">
        @yield('content_body')
    </div>
@stop

{{-- Footer --}}
@section('footer')
    <div class="clinic-footer">
        <div class="clinic-footer__brand">
            <span class="clinic-footer__icon">
                <i class="fas fa-heartbeat"></i>
            </span>

            <span>
                <strong>
                    {{ config('app.company_name', 'Sistem Informasi Klinik') }}
                </strong>
                <small>Pelayanan kesehatan terintegrasi</small>
            </span>
        </div>

        <span class="clinic-footer__version">
            Versi {{ config('app.version', '1.0.0') }}
        </span>
    </div>
@stop

{{-- CSS global --}}
@push('css')
    <style>
        :root {
            --clinic-sage-950: #253b33;
            --clinic-sage-900: #304b40;
            --clinic-sage-800: #3d6253;
            --clinic-sage-700: #52796f;
            --clinic-sage-600: #688f80;
            --clinic-sage-500: #84a98c;
            --clinic-sage-300: #c5d5c5;
            --clinic-sage-100: #e8efe7;

            --clinic-ivory: #f7f7f1;
            --clinic-white: #ffffff;
            --clinic-text: #29372f;
            --clinic-muted: #7b877e;
            --clinic-border: #e6e9e1;

            --clinic-radius: 14px;
            --clinic-shadow: 0 4px 18px rgba(37, 59, 51, 0.045);
        }

        /* Fondasi halaman */
        html,
        body {
            font-family: "Plus Jakarta Sans", "Segoe UI", sans-serif;
            color: var(--clinic-text);
            background: var(--clinic-ivory);
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-size: 13.5px;
        }

        a {
            color: var(--clinic-sage-700);
            transition: color 0.2s ease;
        }

        a:hover {
            color: var(--clinic-sage-900);
        }

        .content-wrapper {
            background: var(--clinic-ivory) !important;
            min-height: calc(100vh - 120px);
        }

        .content {
            padding: 8px 24px 28px;
        }

        .clinic-content {
            width: 100%;
            min-width: 0;
        }

        /* Sidebar */
        .main-sidebar {
            background: var(--clinic-sage-950) !important;
            box-shadow: 4px 0 24px rgba(27, 46, 37, 0.08);
        }

        .brand-link {
            min-height: 68px;
            display: flex !important;
            align-items: center;
            padding: 14px 18px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.09) !important;
            color: #fff !important;
        }

        .brand-link .brand-image {
            width: 36px;
            height: 36px;
            max-height: 36px;
            margin: 0 12px 0 0;
            float: none;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: none;
        }

        .brand-link .brand-text {
            font-size: 15px;
            font-weight: 700 !important;
            letter-spacing: -0.35px;
        }

        .sidebar {
            padding: 12px 10px 20px;
        }

        .nav-sidebar .nav-header {
            padding: 16px 12px 7px;
            color: #aabeb0;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.3px;
        }

        .nav-sidebar .nav-item {
            margin-bottom: 4px;
        }

        .nav-sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px 12px;
            color: #d0ddd3;
            border-radius: 9px;
            font-size: 12.5px;
            font-weight: 500;
            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }

        .nav-sidebar .nav-link p {
            margin: 0;
            white-space: normal;
        }

        .nav-sidebar .nav-link .nav-icon {
            width: 20px;
            margin: 0;
            font-size: 14px;
            text-align: center;
            color: #a9c0b0;
        }

        .nav-sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.075);
        }

        .nav-sidebar .nav-link.active {
            color: #fff !important;
            background: var(--clinic-sage-700) !important;
            box-shadow: 0 4px 12px rgba(15, 32, 24, 0.12);
            font-weight: 600;
        }

        .nav-sidebar .nav-link.active .nav-icon {
            color: #fff !important;
        }

        .nav-sidebar .nav-treeview {
            padding-left: 8px;
        }

        .nav-sidebar .nav-treeview>.nav-item>.nav-link {
            padding-top: 9px;
            padding-bottom: 9px;
            font-size: 12px;
        }

        /* Navbar */
        .main-header {
            min-height: 60px;
            background: rgba(255, 255, 255, 0.96) !important;
            border-bottom: 1px solid var(--clinic-border) !important;
            box-shadow: 0 2px 10px rgba(37, 59, 51, 0.025);
        }

        .main-header .nav-link {
            color: #637168 !important;
        }

        .main-header .nav-link:hover {
            color: var(--clinic-sage-800) !important;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #637168;
        }

        /* Header halaman */
        .content-header {
            padding: 26px 24px 12px;
        }

        .clinic-page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .clinic-page-heading__main {
            min-width: 0;
        }

        .clinic-page-eyebrow {
            display: block;
            margin-bottom: 7px;
            color: var(--clinic-sage-700);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .clinic-page-title {
            margin: 0;
            color: var(--clinic-text);
            font-size: 24px;
            line-height: 1.4;
            font-weight: 750;
            letter-spacing: -0.8px;
        }

        .clinic-page-subtitle {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-left: 8px;
            color: var(--clinic-muted);
            font-size: 15px;
            font-weight: 500;
            letter-spacing: -0.2px;
            vertical-align: middle;
        }

        .clinic-page-subtitle i {
            font-size: 10px;
            color: #a5b0a7;
        }

        /* Kartu dan panel */
        .card {
            margin-bottom: 20px;
            overflow: hidden;
            background: var(--clinic-white);
            border: 1px solid var(--clinic-border);
            border-radius: var(--clinic-radius);
            box-shadow: var(--clinic-shadow);
        }

        .card-header {
            padding: 17px 20px;
            background: #fff;
            border-bottom: 1px solid #edf0e9;
        }

        .card-header .card-title {
            margin: 0;
            color: var(--clinic-text);
            font-size: 14px;
            font-weight: 700;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            padding: 14px 20px;
            background: #fbfcf9;
            border-top: 1px solid #edf0e9;
        }

        /* Tombol */
        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .btn:focus {
            box-shadow: 0 0 0 3px rgba(132, 169, 140, 0.22);
        }

        .btn-primary {
            color: #fff;
            background: var(--clinic-sage-700);
            border-color: var(--clinic-sage-700);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            color: #fff;
            background: var(--clinic-sage-900);
            border-color: var(--clinic-sage-900);
        }

        .btn-success {
            background: #52796f;
            border-color: #52796f;
        }

        .btn-outline-primary {
            color: var(--clinic-sage-700);
            border-color: var(--clinic-sage-300);
        }

        .btn-outline-primary:hover {
            color: #fff;
            background: var(--clinic-sage-700);
            border-color: var(--clinic-sage-700);
        }

        /* Formulir */
        .form-control,
        .custom-select {
            min-height: 39px;
            color: var(--clinic-text);
            background-color: #fff;
            border: 1px solid #dfe5dc;
            border-radius: 8px;
            font-size: 12.5px;
            box-shadow: none;
        }

        .form-control:focus,
        .custom-select:focus {
            border-color: var(--clinic-sage-500);
            box-shadow: 0 0 0 3px rgba(132, 169, 140, 0.15);
        }

        label {
            margin-bottom: 7px;
            color: #46554a;
            font-size: 12px;
            font-weight: 600;
        }

        .form-text,
        .text-muted {
            color: var(--clinic-muted) !important;
        }

        /* Tabel */
        .table {
            color: #3e4b42;
            font-size: 12px;
        }

        .table thead th {
            padding: 13px 14px;
            color: #6b786d;
            background: #f6f8f3;
            border-top: 0;
            border-bottom: 1px solid var(--clinic-border);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.35px;
            text-transform: uppercase;
            vertical-align: middle;
        }

        .table td {
            padding: 13px 14px;
            border-top: 1px solid #edf0e9;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #fafbf8;
        }

        /* Alert dan notifikasi */
        .alert {
            border: 0;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(37, 59, 51, 0.035);
            font-size: 12.5px;
        }

        .alert-success {
            color: #315c46;
            background: #eaf4eb;
            border-left: 4px solid #6c9b79;
        }

        .alert-danger {
            color: #8b3e3e;
            background: #fff0ee;
            border-left: 4px solid #cf7770;
        }

        .alert-warning {
            color: #775b24;
            background: #fff6df;
            border-left: 4px solid #d7ad50;
        }

        /* Badge status */
        .badge-success {
            color: #315c46;
            background: #e4f1e5;
        }

        .badge-warning {
            color: #775b24;
            background: #fff0c9;
        }

        .badge-danger {
            color: #8b3e3e;
            background: #fde8e6;
        }

        .badge-info {
            color: #32635e;
            background: #e1f1ec;
        }

        .badge {
            padding: 5px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 650;
        }

        /* Pagination */
        .page-link {
            margin: 0 2px;
            color: var(--clinic-sage-700);
            border: 1px solid var(--clinic-border);
            border-radius: 7px !important;
            font-size: 12px;
        }

        .page-item.active .page-link {
            background: var(--clinic-sage-700);
            border-color: var(--clinic-sage-700);
        }

        /* Footer */
        .main-footer {
            padding: 16px 24px;
            color: var(--clinic-muted);
            background: #fff;
            border-top: 1px solid var(--clinic-border);
            font-size: 11px;
        }

        .clinic-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .clinic-footer__brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .clinic-footer__icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            color: var(--clinic-sage-700);
            background: var(--clinic-sage-100);
            border-radius: 9px;
            font-size: 14px;
        }

        .clinic-footer__brand strong,
        .clinic-footer__brand small {
            display: block;
        }

        .clinic-footer__brand strong {
            color: var(--clinic-text);
            font-size: 11px;
            font-weight: 700;
        }

        .clinic-footer__brand small {
            margin-top: 2px;
            color: var(--clinic-muted);
            font-size: 10px;
        }

        .clinic-footer__version {
            color: var(--clinic-muted);
            font-size: 10px;
        }

        /* Responsif */
        @media (max-width: 767.98px) {
            .content {
                padding: 5px 12px 20px;
            }

            .content-header {
                padding: 20px 12px 10px;
            }

            .clinic-page-title {
                font-size: 20px;
                letter-spacing: -0.5px;
            }

            .clinic-page-subtitle {
                display: flex;
                margin: 6px 0 0;
                font-size: 12px;
            }

            .card-header {
                padding: 14px 15px;
            }

            .card-body {
                padding: 15px;
            }

            .table-responsive {
                border: 0;
            }

            .main-footer {
                padding: 14px 16px;
            }

            .clinic-footer {
                align-items: flex-start;
            }
        }

        /* Menghormati preferensi pengurangan animasi */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
            }
        }

        /* ========================================
           NAVBAR PASIEN — SAGE GREEN
        ======================================== */

        .main-header {
            position: sticky;
            top: 0;
            z-index: 1030;
            min-height: 68px;
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.96) !important;
            border-bottom: 1px solid var(--clinic-border) !important;
            box-shadow: 0 4px 18px rgba(37, 59, 51, 0.045);
            backdrop-filter: blur(12px);
        }

        .main-header .navbar-nav {
            align-items: center;
        }

        .main-header .nav-link {
            color: #637168;
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        /* Menu navigasi pasien */
        .clinic-patient-nav-item {
            margin: 0 3px;
        }

        .main-header .clinic-patient-nav-link {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 42px;
            margin: 0;
            padding: 10px 16px !important;
            border: 1px solid transparent;
            border-radius: 10px;
            color: #68776d !important;
            font-size: 12.5px;
            font-weight: 600;
            white-space: nowrap;
            transition:
                color 0.2s ease,
                background-color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .main-header .clinic-patient-nav-link i {
            width: 16px;
            color: #7c9683;
            font-size: 14px;
            text-align: center;
            transition: color 0.2s ease;
        }

        /* Hover */
        .main-header .clinic-patient-nav-link:hover {
            color: var(--clinic-sage-900) !important;
            background: #f3f6f0;
            border-color: #e8eee5;
        }

        .main-header .clinic-patient-nav-link:hover i {
            color: var(--clinic-sage-800);
        }

        /* Menu aktif */
        .main-header .clinic-patient-nav-link.active {
            color: var(--clinic-sage-950) !important;
            background: var(--clinic-sage-100);
            border-color: #dce7db;
            font-weight: 700;
        }

        .main-header .clinic-patient-nav-link.active i {
            color: var(--clinic-sage-800);
        }

        /* Fokus keyboard */
        .main-header .clinic-patient-nav-link:focus-visible {
            outline: 2px solid var(--clinic-sage-600);
            outline-offset: 2px;
        }

        /* Dropdown akun bawaan AdminLTE */
        .main-header .navbar-nav .nav-link:hover {
            color: var(--clinic-sage-900) !important;
        }

        .main-header .dropdown-menu {
            margin-top: 8px;
            padding: 7px;
            border: 1px solid var(--clinic-border);
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(37, 59, 51, 0.12);
        }

        .main-header .dropdown-item {
            padding: 10px 12px;
            border-radius: 7px;
            color: var(--clinic-text);
            font-size: 12px;
        }

        .main-header .dropdown-item:hover {
            color: var(--clinic-sage-900);
            background: var(--clinic-sage-100);
        }

        /* Responsif */
        @media (max-width: 767.98px) {
            .main-header {
                min-height: 60px;
                padding: 7px 8px;
            }

            .main-header .clinic-patient-nav-item {
                margin: 0 1px;
            }

            .main-header .clinic-patient-nav-link {
                min-height: 40px;
                gap: 5px;
                padding: 9px 10px !important;
                font-size: 11px;
            }

            .main-header .clinic-patient-nav-link i {
                width: auto;
                font-size: 12px;
            }
        }

        @media (max-width: 420px) {
            .main-header {
                padding-right: 4px;
                padding-left: 4px;
            }

            .main-header .clinic-patient-nav-link {
                gap: 4px;
                padding: 8px 7px !important;
                font-size: 10px;
            }
        }
    </style>
@endpush

@section('js')
    @parent
    @stack('scripts')
@stop
