@extends('adminlte::auth.auth-page', ['authType' => 'register'])

@section('auth_body')
    <div class="auth-modern register-modern">

        {{-- PANEL KIRI --}}
        <div class="auth-visual">
            <a href="{{ url('/') }}" class="auth-brand">
                <span class="brand-icon">
                    <i class="fas fa-heartbeat"></i>
                </span>
                <span class="brand-text">
                    <strong>SISMENKES</strong>
                    <small>Sistem Informasi Klinik</small>
                </span>
            </a>

            <div class="visual-content">
                <span class="visual-badge">
                    <i class="fas fa-user-plus"></i>
                    PENDAFTARAN PASIEN
                </span>

                <h1>Mulai perjalanan kesehatan Anda.</h1>

                <p>
                    Buat akun untuk mengakses layanan klinik, mendapatkan
                    informasi jadwal dokter, dan melihat riwayat pemeriksaan
                    melalui sistem yang terintegrasi.
                </p>

                <div class="register-benefits">
                    <div class="benefit-item">
                        <span class="benefit-icon">
                            <i class="fas fa-calendar-check"></i>
                        </span>
                        <div>
                            <strong>Pendaftaran lebih praktis</strong>
                            <small>Akses pendaftaran poli melalui akun Anda.</small>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <span class="benefit-icon">
                            <i class="fas fa-file-medical-alt"></i>
                        </span>
                        <div>
                            <strong>Informasi lebih terorganisasi</strong>
                            <small>Lihat informasi pemeriksaan yang tersedia.</small>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <span class="benefit-icon">
                            <i class="fas fa-shield-alt"></i>
                        </span>
                        <div>
                            <strong>Akses akun pribadi</strong>
                            <small>Gunakan akun untuk mengakses layanan pasien.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="visual-footer">
                <i class="fas fa-leaf"></i>
                Merawat kesehatan, memudahkan layanan.
            </div>
        </div>

        {{-- PANEL KANAN --}}
        <div class="auth-form-panel">

            <div class="mobile-brand">
                <span class="brand-icon">
                    <i class="fas fa-heartbeat"></i>
                </span>
                <strong>SISMENKES</strong>
            </div>

            <div class="form-heading">
                <span class="form-eyebrow">BUAT AKUN BARU</span>
                <h2>Daftar sebagai pasien</h2>
                <p>Lengkapi data diri Anda sesuai informasi yang benar.</p>
            </div>

            {{-- PESAN VALIDASI --}}
            @if ($errors->any())
                <div class="auth-alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Periksa kembali data Anda.</strong>
                        <p>Masih terdapat data yang belum sesuai.</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="modern-form">
                @csrf

                <div class="register-fields">

                    {{-- NAMA LENGKAP --}}
                    <div class="form-group-modern field-full">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-icon-wrap">
                            <i class="far fa-user"></i>
                            <input id="name" type="text" name="name"
                                class="modern-input @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap"
                                value="{{ old('name') }}" autocomplete="name" required autofocus>
                        </div>
                        @error('name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group-modern">
                        <label for="email">Alamat Email</label>
                        <div class="input-icon-wrap">
                            <i class="far fa-envelope"></i>
                            <input id="email" type="email" name="email"
                                class="modern-input @error('email') is-invalid @enderror" placeholder="nama@email.com"
                                value="{{ old('email') }}" autocomplete="email" required>
                        </div>
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- NOMOR HP --}}
                    <div class="form-group-modern">
                        <label for="no_hp">Nomor HP</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-phone-alt"></i>
                            <input id="no_hp" type="tel" name="no_hp"
                                class="modern-input @error('no_hp') is-invalid @enderror" placeholder="08xxxxxxxxxx"
                                value="{{ old('no_hp') }}" autocomplete="tel" required>
                        </div>
                        @error('no_hp')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- ALAMAT --}}
                    <div class="form-group-modern field-full">
                        <label for="alamat">Alamat Lengkap</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-map-marker-alt"></i>
                            <input id="alamat" type="text" name="alamat"
                                class="modern-input @error('alamat') is-invalid @enderror"
                                placeholder="Nama jalan, kelurahan, dan kota" value="{{ old('alamat') }}"
                                autocomplete="street-address" required>
                        </div>
                        @error('alamat')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- NIK --}}
                    <div class="form-group-modern field-full">
                        <label for="no_ktp">Nomor KTP (NIK)</label>
                        <div class="input-icon-wrap">
                            <i class="far fa-id-card"></i>
                            <input id="no_ktp" type="text" name="no_ktp"
                                class="modern-input @error('no_ktp') is-invalid @enderror"
                                placeholder="Masukkan 16 digit NIK" value="{{ old('no_ktp') }}" inputmode="numeric"
                                maxlength="16" autocomplete="off" required>
                        </div>
                        @error('no_ktp')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="form-group-modern">
                        <label for="password">Password</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" name="password"
                                class="modern-input @error('password') is-invalid @enderror" placeholder="Buat password"
                                autocomplete="new-password" required>
                            <button type="button" class="toggle-password" data-target="password"
                                aria-label="Tampilkan password" aria-pressed="false">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="form-group-modern">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-lock"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="modern-input" placeholder="Ulangi password" autocomplete="new-password" required>
                            <button type="button" class="toggle-password" data-target="password_confirmation"
                                aria-label="Tampilkan password" aria-pressed="false">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <button type="submit" class="auth-submit">
                    Buat Akun Pasien
                    <i class="fas fa-arrow-right"></i>
                </button>

                <p class="form-note">
                    Pastikan data diri dan nomor identitas yang Anda masukkan benar.
                </p>
            </form>

            <div class="auth-divider">
                <span>atau</span>
            </div>

            <p class="auth-switch">
                Sudah memiliki akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </p>

            <a href="{{ url('/') }}" class="back-home">
                <i class="fas fa-arrow-left"></i>
                Kembali ke halaman utama
            </a>
        </div>
    </div>
@stop

@push('css')
    <style>
        :root {
            --auth-green: #426b58;
            --auth-green-dark: #2e5141;
            --auth-green-pale: #eaf1e8;
            --auth-ivory: #faf9f5;
            --auth-text: #293a30;
            --auth-muted: #7b887e;
            --auth-border: #e5eae3;
        }

        /* =====================================
           HALAMAN REGISTER
        ===================================== */

        body.register-page {
            min-height: 100vh;
            padding: 28px 0;
            background: var(--auth-ivory) !important;
            font-family: 'Source Sans Pro', sans-serif;
        }

        body.register-page .content-wrapper {
            background: var(--auth-ivory) !important;
        }

        body.register-page .register-box {
            float: none !important;
            width: calc(100% - 48px) !important;
            max-width: 1150px !important;
            margin: 0 auto !important;
        }

        body.register-page .register-logo,
        body.register-page .register-box>.card>.card-header,
        body.register-page .register-box>.card>.card-footer {
            display: none !important;
        }

        body.register-page .register-box>.card {
            width: 100%;
            margin: 0;
            overflow: hidden;
            border: 1px solid rgba(229, 234, 227, .95) !important;
            border-radius: 22px !important;
            background: #fff;
            box-shadow: 0 20px 60px rgba(41, 58, 48, .08) !important;
        }

        body.register-page .register-box .card-body {
            width: 100%;
            padding: 0 !important;
        }

        /* =====================================
           MAIN LAYOUT
        ===================================== */

        .register-modern {
            display: grid;
            grid-template-columns: minmax(0, .82fr) minmax(0, 1.18fr);
            width: 100%;
            min-width: 0;
        }

        .auth-visual,
        .auth-form-panel {
            min-width: 0;
            box-sizing: border-box;
        }

        /* =====================================
           LEFT PANEL
        ===================================== */

        .auth-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            min-height: 790px;
            padding: 38px 34px;
            background: linear-gradient(150deg,
                    #f0f5ed 0%,
                    #e5eee2 55%,
                    #d9e7d8 100%);
        }

        .auth-brand {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            align-self: flex-start;
            gap: 11px;
            color: var(--auth-text) !important;
            text-decoration: none !important;
        }

        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: var(--auth-green);
            color: #fff;
            font-size: 20px;
        }

        .brand-text strong,
        .brand-text small {
            display: block;
        }

        .brand-text strong {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .6px;
        }

        .brand-text small {
            margin-top: 3px;
            color: var(--auth-muted);
            font-size: 10px;
        }

        .visual-content {
            position: relative;
            z-index: 1;
            margin: 45px 0;
        }

        .visual-badge,
        .form-eyebrow {
            color: var(--auth-green);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.4px;
        }

        .visual-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border: 1px solid rgba(66, 107, 88, .15);
            border-radius: 30px;
            background: rgba(255, 255, 255, .6);
        }

        .visual-content h1 {
            max-width: 390px;
            margin: 24px 0 15px;
            color: #294635;
            font-size: clamp(29px, 3vw, 37px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -.8px;
        }

        .visual-content>p {
            max-width: 390px;
            margin: 0;
            color: #687c6c;
            font-size: 13px;
            line-height: 1.9;
        }

        .register-benefits {
            display: grid;
            gap: 22px;
            margin-top: 42px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
        }

        .benefit-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            border: 1px solid rgba(66, 107, 88, .1);
            border-radius: 12px;
            background: rgba(255, 255, 255, .75);
            color: var(--auth-green);
            font-size: 15px;
        }

        .benefit-item strong,
        .benefit-item small {
            display: block;
        }

        .benefit-item strong {
            margin: 2px 0 5px;
            color: #304838;
            font-size: 12px;
            font-weight: 800;
        }

        .benefit-item small {
            color: #718276;
            font-size: 11px;
            line-height: 1.6;
        }

        .visual-footer {
            position: relative;
            z-index: 1;
            color: #68806c;
            font-size: 11px;
        }

        .visual-footer i {
            margin-right: 7px;
            color: var(--auth-green);
        }

        /* =====================================
           RIGHT PANEL
        ===================================== */

        .auth-form-panel {
            align-self: center;
            padding: 46px clamp(28px, 4vw, 52px);
            background: #fff;
        }

        .mobile-brand {
            display: none;
        }

        .form-heading {
            margin-bottom: 27px;
        }

        .form-heading h2 {
            margin: 11px 0 8px;
            color: var(--auth-text);
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .form-heading p {
            margin: 0;
            color: var(--auth-muted);
            font-size: 12px;
            line-height: 1.7;
        }

        /* =====================================
           VALIDATION ALERT
        ===================================== */

        .auth-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
            padding: 12px 14px;
            border: 1px solid #f0d8d5;
            border-radius: 10px;
            background: #fff5f3;
            color: #a94442;
            font-size: 11px;
            line-height: 1.6;
        }

        .auth-alert>i {
            margin-top: 2px;
        }

        .auth-alert strong {
            display: block;
        }

        .auth-alert p {
            margin: 2px 0 0;
        }

        /* =====================================
           FORM GRID
        ===================================== */

        .register-fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            column-gap: 17px;
            row-gap: 0;
            width: 100%;
        }

        .form-group-modern {
            min-width: 0;
            margin-bottom: 19px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        .form-group-modern>label {
            display: block;
            margin-bottom: 8px;
            color: #3a4b40;
            font-size: 11px;
            font-weight: 700;
        }

        /* =====================================
           INPUT
        ===================================== */

        .input-icon-wrap {
            position: relative;
            width: 100%;
            min-width: 0;
        }

        .input-icon-wrap>i:first-child {
            position: absolute;
            top: 50%;
            left: 13px;
            z-index: 2;
            color: #849388;
            font-size: 12px;
            pointer-events: none;
            transform: translateY(-50%);
        }

        .modern-input {
            display: block;
            width: 100%;
            height: 45px;
            min-width: 0;
            box-sizing: border-box;
            padding: 10px 38px 10px 37px;
            border: 1px solid var(--auth-border);
            border-radius: 9px;
            outline: none;
            background: #fcfdfb;
            color: var(--auth-text);
            font-family: inherit;
            font-size: 12px;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .modern-input::placeholder {
            color: #a0aaa2;
        }

        .modern-input:focus {
            border-color: #7eaa8b;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(66, 107, 88, .1);
        }

        .modern-input.is-invalid {
            border-color: #dc7373;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            border: 0;
            background: transparent;
            color: #849388;
            cursor: pointer;
            transform: translateY(-50%);
        }

        .toggle-password:hover {
            color: var(--auth-green);
        }

        .field-error {
            display: block;
            margin-top: 6px;
            color: #c44747;
            font-size: 10px;
            line-height: 1.5;
        }

        /* =====================================
           SUBMIT BUTTON
        ===================================== */

        .auth-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            min-height: 48px;
            margin-top: 4px;
            border: 0;
            border-radius: 10px;
            background: var(--auth-green);
            color: #fff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            transition: background .2s, transform .2s, box-shadow .2s;
            cursor: pointer;
        }

        .auth-submit:hover {
            background: var(--auth-green-dark);
            box-shadow: 0 8px 18px rgba(46, 81, 65, .16);
            transform: translateY(-1px);
        }

        .form-note {
            margin: 12px 0 0;
            color: #89948b;
            font-size: 10px;
            line-height: 1.7;
            text-align: center;
        }

        /* =====================================
           FOOTER FORM
        ===================================== */

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 23px 0;
            color: #a0aaa2;
            font-size: 10px;
        }

        .auth-divider::before,
        .auth-divider::after {
            flex: 1;
            height: 1px;
            background: #edf0eb;
            content: '';
        }

        .auth-switch {
            margin: 0;
            color: var(--auth-muted);
            font-size: 11px;
            text-align: center;
        }

        .auth-switch a {
            color: var(--auth-green);
            font-weight: 800;
            text-decoration: none !important;
        }

        .auth-switch a:hover {
            color: var(--auth-green-dark);
            text-decoration: underline !important;
        }

        .back-home {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 23px;
            color: #859087;
            font-size: 10px;
            text-decoration: none !important;
        }

        .back-home:hover {
            color: var(--auth-green);
        }

        /* =====================================
           TABLET
        ===================================== */

        @media (max-width: 991px) and (min-width: 768px) {
            body.register-page .register-box {
                width: calc(100% - 30px) !important;
            }

            .register-modern {
                grid-template-columns: minmax(0, .72fr) minmax(0, 1.28fr);
            }

            .auth-visual {
                padding: 30px 24px;
            }

            .auth-form-panel {
                padding: 36px 25px;
            }

            .visual-content h1 {
                font-size: 29px;
            }

            .register-fields {
                column-gap: 12px;
            }

            .modern-input {
                font-size: 11px;
            }
        }

        /* =====================================
           MOBILE
        ===================================== */

        @media (max-width: 767px) {
            body.register-page {
                padding: 12px 0;
            }

            body.register-page .register-box {
                width: calc(100% - 24px) !important;
                max-width: 560px !important;
            }

            body.register-page .register-box>.card {
                border-radius: 17px !important;
            }

            .register-modern {
                display: block;
                min-height: auto;
            }

            .auth-visual {
                display: none;
            }

            .auth-form-panel {
                width: 100%;
                padding: 30px 23px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 28px;
                color: var(--auth-text);
                font-size: 14px;
                font-weight: 800;
                letter-spacing: .5px;
            }

            .mobile-brand .brand-icon {
                width: 39px;
                height: 39px;
                font-size: 18px;
            }

            .form-heading {
                margin-bottom: 23px;
            }

            .form-heading h2 {
                font-size: 25px;
            }

            .register-fields {
                grid-template-columns: minmax(0, 1fr);
                column-gap: 0;
            }

            .field-full {
                grid-column: auto;
            }
        }

        /* =====================================
           SMALL MOBILE
        ===================================== */

        @media (max-width: 380px) {
            .auth-form-panel {
                padding: 25px 17px;
            }

            .form-heading h2 {
                font-size: 23px;
            }

            .modern-input {
                height: 43px;
                font-size: 11px;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('click', function(event) {
            const button = event.target.closest('.toggle-password');

            if (!button) {
                return;
            }

            const input = document.getElementById(button.dataset.target);

            if (!input) {
                return;
            }

            const showPassword = input.type === 'password';

            input.type = showPassword ? 'text' : 'password';

            button.setAttribute('aria-pressed', String(showPassword));
            button.setAttribute(
                'aria-label',
                showPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );

            const icon = button.querySelector('i');

            if (icon) {
                icon.classList.toggle('fa-eye', !showPassword);
                icon.classList.toggle('fa-eye-slash', showPassword);
            }
        });
    </script>
@endpush
