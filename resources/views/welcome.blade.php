@extends('layouts.app')

@section('subtitle', 'Sistem Informasi Klinik')

@section('content_header')
@stop

@section('content')
    <div class="landing-page">
        {{-- Navbar --}}
        <nav class="landing-navbar">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-icon">
                    <i class="fas fa-heartbeat"></i>
                </span>
                <span>
                    <strong>SISMENKES</strong>
                    <small>Sistem Informasi Klinik</small>
                </span>
            </a>

            <div class="nav-actions">
                <a href="{{ route('login') }}" class="nav-login">Masuk</a>
                <a href="{{ route('register') }}" class="nav-register">
                    Daftar Sekarang
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </nav>

        {{-- Hero --}}
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="status-dot"></span>
                    Layanan kesehatan dalam satu sistem
                </div>

                <h1>
                    Kesehatan Anda,<br>
                    <span>Prioritas Kami.</span>
                </h1>

                <p class="hero-description">
                    Akses layanan klinik dengan lebih mudah. Daftar kunjungan,
                    lihat jadwal dokter, dan pantau informasi pemeriksaan
                    Anda melalui satu platform yang praktis.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn-primary-custom">
                        Mulai Sekarang
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary-custom">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk ke Akun
                    </a>
                </div>

                <div class="hero-trust">
                    <span class="trust-icon">
                        <i class="fas fa-shield-alt"></i>
                    </span>
                    <span>
                        <strong>Akses lebih praktis</strong>
                        <small>Informasi layanan dalam satu tempat</small>
                    </span>
                </div>
            </div>

            {{-- Visual --}}
            <div class="hero-visual">
                <div class="visual-orbit orbit-one"></div>
                <div class="visual-orbit orbit-two"></div>

                <div class="medical-illustration">
                    <div class="illustration-top">
                        <span class="illustration-label">
                            <i class="fas fa-plus-circle"></i>
                            Pelayanan Kesehatan
                        </span>
                        <span class="illustration-status">
                            <span></span> Terintegrasi
                        </span>
                    </div>

                    <div class="medical-symbol">
                        <div class="symbol-cross">
                            <span></span>
                            <span></span>
                        </div>
                        <div class="symbol-ring ring-one"></div>
                        <div class="symbol-ring ring-two"></div>
                        <i class="fas fa-heartbeat symbol-heart"></i>
                    </div>

                    <div class="illustration-bottom">
                        <div>
                            <span class="bottom-label">SISMENKES</span>
                            <strong>Layanan Klinik Digital</strong>
                        </div>
                        <span class="bottom-icon">
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </span>
                    </div>
                </div>

                <div class="floating-card floating-card-top">
                    <span class="floating-icon calendar-icon">
                        <i class="fas fa-calendar-check"></i>
                    </span>
                    <span>
                        <strong>Jadwal Dokter</strong>
                        <small>Informasi lebih mudah diakses</small>
                    </span>
                </div>

                <div class="floating-card floating-card-bottom">
                    <span class="floating-icon health-icon">
                        <i class="fas fa-notes-medical"></i>
                    </span>
                    <span>
                        <strong>Riwayat Pemeriksaan</strong>
                        <small>Informasi tersimpan terpusat</small>
                    </span>
                </div>
            </div>
        </section>

        {{-- Feature section --}}
        <section class="features-section">
            <div class="section-heading">
                <span class="section-eyebrow">LAYANAN KAMI</span>
                <h2>Pengalaman layanan klinik yang lebih mudah</h2>
                <p>Fitur yang membantu Anda mengakses informasi dan mengelola kunjungan.</p>
            </div>

            <div class="features-grid">
                <article class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Pendaftaran Poli</h3>
                    <p>Daftarkan kunjungan ke poli yang tersedia dengan alur yang praktis.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Informasi Jadwal Dokter</h3>
                    <p>Lihat informasi jadwal praktik dokter untuk membantu merencanakan kunjungan.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <h3>Riwayat Pemeriksaan</h3>
                    <p>Akses informasi pemeriksaan dan catatan yang tersedia melalui akun Anda.</p>
                </article>
            </div>
        </section>

        {{-- CTA --}}
        <section class="cta-section">
            <div>
                <span class="cta-eyebrow">LANGKAH PERTAMA ANDA</span>
                <h2>Mulai akses layanan klinik dengan mudah.</h2>
                <p>Buat akun untuk menggunakan fitur layanan pasien SISMENKES.</p>
            </div>
            <a href="{{ route('register') }}" class="cta-button">
                Buat Akun
                <i class="fas fa-arrow-right"></i>
            </a>
        </section>

        {{-- Footer --}}
        <footer class="landing-footer">
            <a href="{{ url('/') }}" class="footer-brand">
                <i class="fas fa-heartbeat"></i>
                SISMENKES
            </a>
            <p>Sistem Informasi Klinik untuk akses layanan yang lebih praktis.</p>
            <span>&copy; {{ date('Y') }} SISMENKES. Semua hak dilindungi.</span>
        </footer>
    </div>
@stop

@push('css')
    <style>
        /*
        |--------------------------------------------------------------------------
        | Landing Page SISMENKES
        |--------------------------------------------------------------------------
        */

        :root {
            --landing-green: #426b58;
            --landing-green-dark: #2e5141;
            --landing-green-light: #e8f0e9;
            --landing-ivory: #faf9f5;
            --landing-text: #23352c;
            --landing-muted: #718077;
            --landing-border: #e7eae4;
        }

        /* Sembunyikan navigasi AdminLTE hanya pada halaman landing */
        body:has(.landing-page) .main-sidebar,
        body:has(.landing-page) .main-header,
        body:has(.landing-page) .main-footer,
        body:has(.landing-page) .content-header,
        body:has(.landing-page) .control-sidebar {
            display: none !important;
        }

        body:has(.landing-page) .content-wrapper,
        body:has(.landing-page) .content,
        body:has(.landing-page) .content-wrapper>.content {
            margin-left: 0 !important;
            min-height: 100vh;
            background: var(--landing-ivory) !important;
        }

        body:has(.landing-page) .content {
            padding: 0 !important;
        }

        body:has(.landing-page) .content-wrapper {
            margin-top: 0 !important;
        }

        body:has(.landing-page) .container-fluid,
        body:has(.landing-page) .container {
            max-width: none !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .landing-page {
            min-height: 100vh;
            overflow: hidden;
            background: var(--landing-ivory);
            color: var(--landing-text);
            font-family: 'Source Sans Pro', sans-serif;
        }

        .landing-navbar {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            min-height: 88px;
            padding: 18px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            border-bottom: 1px solid rgba(48, 76, 58, .08);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--landing-text);
            text-decoration: none !important;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: var(--landing-green);
            color: white;
            font-size: 22px;
            box-shadow: 0 6px 16px rgba(66, 107, 88, .18);
        }

        .brand strong,
        .brand small {
            display: block;
        }

        .brand strong {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: .7px;
        }

        .brand small {
            margin-top: 2px;
            color: var(--landing-muted);
            font-size: 12px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 26px;
        }

        .nav-login {
            color: var(--landing-text);
            font-weight: 700;
            text-decoration: none !important;
        }

        .nav-login:hover {
            color: var(--landing-green);
        }

        .nav-register,
        .btn-primary-custom,
        .cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border-radius: 10px;
            background: var(--landing-green);
            color: #fff !important;
            font-weight: 700;
            text-decoration: none !important;
            transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
        }

        .nav-register {
            padding: 13px 18px;
            font-size: 13px;
        }

        .nav-register:hover,
        .btn-primary-custom:hover,
        .cta-button:hover {
            background: var(--landing-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 9px 20px rgba(46, 81, 65, .16);
        }

        .hero-section {
            position: relative;
            max-width: 1440px;
            min-height: 570px;
            margin: 0 auto;
            padding: 76px 7% 82px;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            gap: 45px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 13px;
            border: 1px solid #dce7dd;
            border-radius: 30px;
            background: #f0f5ee;
            color: var(--landing-green-dark);
            font-size: 12px;
            font-weight: 700;
        }

        .status-dot,
        .illustration-status span {
            width: 7px;
            height: 7px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #6e9d78;
        }

        .hero-content h1 {
            margin: 25px 0 20px;
            color: var(--landing-text);
            font-size: clamp(40px, 4.4vw, 62px);
            line-height: 1.12;
            letter-spacing: -2px;
            font-weight: 800;
        }

        .hero-content h1 span {
            color: var(--landing-green);
        }

        .hero-description {
            max-width: 520px;
            margin-bottom: 28px;
            color: #68766d;
            font-size: 16px;
            line-height: 1.9;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn-primary-custom,
        .btn-secondary-custom {
            min-height: 49px;
            padding: 14px 20px;
            font-size: 13px;
        }

        .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid #dfe5de;
            border-radius: 10px;
            background: #fff;
            color: var(--landing-text) !important;
            font-weight: 700;
            text-decoration: none !important;
            transition: border-color .2s ease, background .2s ease;
        }

        .btn-secondary-custom:hover {
            border-color: #a7bdab;
            background: #f3f7f1;
        }

        .hero-trust {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-top: 32px;
        }

        .trust-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            border-radius: 12px;
            background: #e8f0e9;
            color: var(--landing-green);
            font-size: 17px;
        }

        .hero-trust strong,
        .hero-trust small {
            display: block;
        }

        .hero-trust strong {
            font-size: 12px;
            font-weight: 700;
        }

        .hero-trust small {
            margin-top: 3px;
            color: var(--landing-muted);
            font-size: 11px;
        }

        /* Hero illustration */
        .hero-visual {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 410px;
        }

        .visual-orbit {
            position: absolute;
            border: 1px solid #dce6da;
            border-radius: 50%;
            pointer-events: none;
        }

        .orbit-one {
            width: 390px;
            height: 390px;
        }

        .orbit-two {
            width: 310px;
            height: 310px;
            border-style: dashed;
            opacity: .8;
        }

        .medical-illustration {
            position: relative;
            z-index: 1;
            width: min(100%, 360px);
            padding: 22px;
            border: 1px solid rgba(255, 255, 255, .9);
            border-radius: 24px;
            background: linear-gradient(145deg, #edf3e9, #dce9dc);
            box-shadow: 0 24px 65px rgba(44, 76, 57, .12);
        }

        .illustration-top,
        .illustration-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .illustration-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #3d624c;
            font-size: 11px;
            font-weight: 700;
        }

        .illustration-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 20px;
            background: rgba(255, 255, 255, .7);
            color: #55765d;
            font-size: 9px;
            font-weight: 700;
        }

        .medical-symbol {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 230px;
        }

        .symbol-cross {
            position: relative;
            z-index: 2;
            width: 115px;
            height: 115px;
            border-radius: 32px;
            background: var(--landing-green);
            transform: rotate(-8deg);
            box-shadow: 0 16px 35px rgba(53, 95, 70, .25);
        }

        .symbol-cross span {
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 4px;
            background: white;
            transform: translate(-50%, -50%);
        }

        .symbol-cross span:first-child {
            width: 58px;
            height: 17px;
        }

        .symbol-cross span:last-child {
            width: 17px;
            height: 58px;
        }

        .symbol-ring {
            position: absolute;
            border: 1px solid rgba(66, 107, 88, .15);
            border-radius: 50%;
        }

        .ring-one {
            width: 185px;
            height: 185px;
        }

        .ring-two {
            width: 225px;
            height: 225px;
            border-style: dashed;
        }

        .symbol-heart {
            position: absolute;
            right: 30px;
            bottom: 33px;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border: 4px solid #edf3e9;
            border-radius: 15px;
            background: #fff;
            color: #bd7772;
            font-size: 20px;
            transform: rotate(5deg);
        }

        .illustration-bottom {
            padding-top: 17px;
            border-top: 1px solid rgba(66, 107, 88, .15);
        }

        .bottom-label,
        .illustration-bottom strong {
            display: block;
        }

        .bottom-label {
            margin-bottom: 5px;
            color: #728b77;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.4px;
        }

        .illustration-bottom strong {
            color: #2d4e3c;
            font-size: 13px;
        }

        .bottom-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .75);
            color: var(--landing-green);
        }

        .floating-card {
            position: absolute;
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 13px 15px;
            border: 1px solid rgba(231, 234, 228, .9);
            border-radius: 14px;
            background: rgba(255, 255, 255, .96);
            box-shadow: 0 12px 32px rgba(35, 53, 44, .1);
        }

        .floating-card-top {
            top: 42px;
            right: -8px;
        }

        .floating-card-bottom {
            bottom: 38px;
            left: -20px;
        }

        .floating-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            border-radius: 11px;
            font-size: 16px;
        }

        .calendar-icon {
            background: #e9f0e7;
            color: #426b58;
        }

        .health-icon {
            background: #f5eae5;
            color: #b67868;
        }

        .floating-card strong,
        .floating-card small {
            display: block;
            white-space: nowrap;
        }

        .floating-card strong {
            color: #304438;
            font-size: 11px;
            font-weight: 800;
        }

        .floating-card small {
            margin-top: 4px;
            color: #829087;
            font-size: 9px;
        }

        /* Features */
        .features-section {
            padding: 76px 7% 82px;
            background: #fff;
            border-top: 1px solid #edf0e9;
        }

        .section-heading {
            max-width: 650px;
            margin: 0 auto 38px;
            text-align: center;
        }

        .section-eyebrow,
        .cta-eyebrow {
            color: var(--landing-green);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .section-heading h2 {
            margin: 14px 0 12px;
            color: var(--landing-text);
            font-size: clamp(25px, 3vw, 34px);
            line-height: 1.3;
            letter-spacing: -.7px;
            font-weight: 800;
        }

        .section-heading p {
            margin: 0;
            color: var(--landing-muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .feature-card {
            padding: 27px 25px;
            border: 1px solid var(--landing-border);
            border-radius: 16px;
            background: #fff;
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-color: #cad9ca;
            box-shadow: 0 15px 35px rgba(35, 53, 44, .06);
        }

        .feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 49px;
            height: 49px;
            margin-bottom: 20px;
            border-radius: 14px;
            background: var(--landing-green-light);
            color: var(--landing-green);
            font-size: 20px;
        }

        .feature-card h3 {
            margin: 0 0 10px;
            color: var(--landing-text);
            font-size: 16px;
            font-weight: 800;
        }

        .feature-card p {
            margin: 0;
            color: var(--landing-muted);
            font-size: 13px;
            line-height: 1.8;
        }

        /* CTA */
        .cta-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            max-width: 1100px;
            margin: 64px auto;
            padding: 38px 42px;
            border-radius: 20px;
            background: #eaf1e8;
        }

        .cta-section h2 {
            max-width: 570px;
            margin: 10px 0;
            color: #294635;
            font-size: clamp(22px, 2.5vw, 29px);
            font-weight: 800;
            line-height: 1.3;
        }

        .cta-section p {
            margin: 0;
            color: #6d7e70;
            font-size: 13px;
            line-height: 1.7;
        }

        .cta-button {
            flex-shrink: 0;
            padding: 15px 21px;
            font-size: 13px;
        }

        /* Footer */
        .landing-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px 24px;
            padding: 26px 7%;
            border-top: 1px solid #e7eae4;
            background: #fff;
        }

        .footer-brand {
            color: var(--landing-green-dark);
            font-size: 13px;
            font-weight: 800;
            text-decoration: none !important;
        }

        .footer-brand i {
            margin-right: 6px;
            font-size: 16px;
        }

        .landing-footer p,
        .landing-footer>span {
            margin: 0;
            color: #879188;
            font-size: 11px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-section {
                grid-template-columns: 1fr;
                gap: 30px;
                padding-top: 65px;
            }

            .hero-content {
                max-width: 720px;
            }

            .hero-visual {
                min-height: 400px;
            }

            .features-grid {
                gap: 14px;
            }

            .feature-card {
                padding: 22px 18px;
            }

            .cta-section {
                margin: 45px 5%;
            }
        }

        @media (max-width: 767px) {
            .landing-navbar {
                min-height: 74px;
                padding: 14px 5%;
            }

            .brand-icon {
                width: 40px;
                height: 40px;
                font-size: 19px;
            }

            .brand strong {
                font-size: 14px;
            }

            .brand small {
                font-size: 10px;
            }

            .nav-actions {
                gap: 12px;
            }

            .nav-login {
                font-size: 12px;
            }

            .nav-register {
                gap: 7px;
                padding: 11px 12px;
                font-size: 11px;
            }

            .hero-section {
                padding: 54px 6% 65px;
            }

            .hero-content h1 {
                font-size: clamp(38px, 9vw, 54px);
                letter-spacing: -1.5px;
            }

            .hero-description {
                font-size: 14px;
            }

            .hero-visual {
                min-height: 360px;
                margin: 0 -5px;
            }

            .orbit-one {
                width: 310px;
                height: 310px;
            }

            .orbit-two {
                width: 255px;
                height: 255px;
            }

            .medical-illustration {
                width: min(88%, 320px);
                padding: 17px;
            }

            .medical-symbol {
                height: 190px;
            }

            .symbol-cross {
                width: 95px;
                height: 95px;
                border-radius: 26px;
            }

            .symbol-cross span:first-child {
                width: 48px;
                height: 14px;
            }

            .symbol-cross span:last-child {
                width: 14px;
                height: 48px;
            }

            .ring-one {
                width: 155px;
                height: 155px;
            }

            .ring-two {
                width: 190px;
                height: 190px;
            }

            .symbol-heart {
                right: 25px;
                bottom: 25px;
                width: 39px;
                height: 39px;
                font-size: 17px;
            }

            .floating-card {
                padding: 10px;
                gap: 8px;
            }

            .floating-card-top {
                top: 20px;
                right: -1px;
            }

            .floating-card-bottom {
                bottom: 17px;
                left: -1px;
            }

            .floating-icon {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }

            .floating-card strong {
                font-size: 10px;
            }

            .floating-card small {
                font-size: 8px;
            }

            .features-section {
                padding: 58px 6%;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .feature-card {
                padding: 22px;
            }

            .feature-icon {
                margin-bottom: 15px;
            }

            .cta-section {
                align-items: flex-start;
                flex-direction: column;
                margin: 30px 5%;
                padding: 28px 24px;
            }

            .landing-footer {
                align-items: flex-start;
                flex-direction: column;
                padding: 25px 6%;
            }
        }

        @media (max-width: 380px) {
            .brand {
                gap: 8px;
            }

            .brand small {
                display: none;
            }

            .nav-actions {
                gap: 9px;
            }

            .nav-register {
                padding: 10px;
            }

            .hero-actions {
                flex-direction: column;
            }

            .hero-actions a {
                width: 100%;
            }

            .floating-card small {
                white-space: normal;
            }
        }
    </style>
@endpush
