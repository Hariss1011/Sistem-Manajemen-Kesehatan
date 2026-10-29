@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_body')
    <div class="auth-modern register-modern">
        <div class="auth-visual">
            <a href="{{ url('/') }}" class="auth-brand">
                <span class="brand-icon"><i class="fas fa-heartbeat"></i></span>
                <span>
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
                        <span><i class="fas fa-calendar-check"></i></span>
                        <div>
                            <strong>Pendaftaran lebih praktis</strong>
                            <small>Akses pendaftaran poli melalui akun Anda.</small>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <span><i class="fas fa-file-medical-alt"></i></span>
                        <div>
                            <strong>Informasi lebih terorganisasi</strong>
                            <small>Lihat informasi pemeriksaan yang tersedia.</small>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <span><i class="fas fa-lock"></i></span>
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

        <div class="auth-form-panel">
            <div class="mobile-brand">
                <span class="brand-icon"><i class="fas fa-heartbeat"></i></span>
                <strong>SISMENKES</strong>
            </div>

            <div class="form-heading">
                <span class="form-eyebrow">BUAT AKUN BARU</span>
                <h2>Daftar sebagai pasien</h2>
                <p>Lengkapi data diri Anda sesuai informasi yang benar.</p>
            </div>

            @if ($errors->any())
                <div class="auth-alert auth-alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Periksa kembali data Anda.</strong>
                        <div>Masih terdapat data yang belum sesuai.</div>
                    </div>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="modern-form">
                @csrf

                <div class="register-fields">
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

            <div class="auth-divider"><span>atau</span></div>

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

        body.register-page,
        body.register-page .content-wrapper {
            background: var(--auth-ivory) !important;
        }

        body.register-page {
            min-height: 100vh;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .register-box {
            width: min(1100px, calc(100% - 32px)) !important;
            max-width: 1100px !important;
            margin: 28px auto !important;
        }

        .register-box .card {
            overflow: hidden;
            border: 1px solid rgba(229, 234, 227, .9) !important;
            border-radius: 22px !important;
            background: #fff;
            box-shadow: 0 22px 65px rgba(41, 58, 48, .09) !important;
        }

        .register-box .card-body {
            padding: 0 !important;
        }

        .register-box .register-logo,
        .register-box .card-header,
        .register-box .card-footer {
            display: none !important;
        }

        .register-modern {
            display: grid;
            grid-template-columns: .78fr 1.22fr;
            min-height: 720px;
        }

        .auth-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 34px;
            background: linear-gradient(150deg, #f0f5ed 0%, #e1ecdf 55%, #d7e5d6 100%);
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
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border-radius: 13px;
            background: var(--auth-green);
            color: #fff;
            font-size: 20px;
        }

        .auth-brand strong,
        .auth-brand small {
            display: block;
        }

        .auth-brand strong {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .6px;
        }

        .auth-brand small {
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
            letter-spacing: 1.5px;
        }

        .visual-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 10px;
            border: 1px solid rgba(66, 107, 88, .14);
            border-radius: 30px;
            background: rgba(255, 255, 255, .55);
            letter-spacing: .8px;
        }

        .visual-content h1 {
            margin: 22px 0 14px;
            color: #294635;
            font-size: 33px;
            font-weight: 800;
            line-height: 1.22;
            letter-spacing: -.8px;
        }

        .visual-content>p {
            margin: 0;
            color: #687c6c;
            font-size: 12px;
            line-height: 1.9;
        }

        .register-benefits {
            display: grid;
            gap: 20px;
            margin-top: 35px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .benefit-item>span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            border: 1px solid rgba(66, 107, 88, .1);
            border-radius: 11px;
            background: rgba(255, 255, 255, .7);
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
            font-size: 11px;
            font-weight: 800;
        }

        .benefit-item small {
            color: #718276;
            font-size: 10px;
            line-height: 1.6;
        }

        .visual-footer {
            position: relative;
            z-index: 1;
            color: #68806c;
            font-size: 10px;
        }

        .visual-footer i {
            margin-right: 6px;
            color: var(--auth-green);
        }

        .auth-form-panel {
            align-self: center;
            padding: 42px 43px;
        }

        .mobile-brand {
            display: none;
        }

        .form-heading {
            margin-bottom: 26px;
        }

        .form-heading h2 {
            margin: 10px 0 8px;
            color: var(--auth-text);
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .form-heading p {
            margin: 0;
            color: var(--auth-muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .auth-alert {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-bottom: 18px;
            padding: 11px 13px;
            border: 1px solid #f0d8d5;
            border-radius: 9px;
            background: #fff5f3;
            color: #a94442;
            font-size: 11px;
            line-height: 1.6;
        }

        .register-fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            column-gap: 16px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        .form-group-modern {
            min-width: 0;
            margin-bottom: 17px;
        }

        .form-group-modern>label {
            display: block;
            margin-bottom: 8px;
            color: #3a4b40;
            font-size: 11px;
            font-weight: 700;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap>i:first-child {
            position: absolute;
            top: 50%;
            left: 12px;
            z-index: 2;
            color: #849388;
            font-size: 12px;
            transform: translateY(-50%);
        }

        .modern-input {
            display: block;
            width: 100%;
            height: 44px;
            padding: 10px 37px 10px 35px;
            border: 1px solid var(--auth-border);
            border-radius: 9px;
            outline: none;
            background: #fcfdfb;
            color: var(--auth-text);
            font-size: 11px;
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
            right: 9px;
            padding: 4px;
            border: 0;
            background: transparent;
            color: #849388;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .toggle-password:hover {
            color: var(--auth-green);
        }

        .field-error {
            display: block;
            margin-top: 5px;
            color: #c44747;
            font-size: 10px;
            line-height: 1.5;
        }

        .auth-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            min-height: 47px;
            margin-top: 5px;
            border: 0;
            border-radius: 10px;
            background: var(--auth-green);
            color: #fff;
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

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 21px 0;
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

        @media (max-width: 991px) {
            .register-modern {
                grid-template-columns: .72fr 1.28fr;
            }

            .auth-visual {
                padding: 27px;
            }

            .auth-form-panel {
                padding: 34px 28px;
            }

            .visual-content h1 {
                font-size: 29px;
            }

            .register-fields {
                column-gap: 12px;
            }
        }

        @media (max-width: 767px) {
            .register-box {
                width: calc(100% - 24px) !important;
                margin: 12px auto !important;
            }

            .register-box .card {
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
                padding: 28px 22px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 27px;
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

            .form-heading h2 {
                font-size: 24px;
            }

            .register-fields {
                grid-template-columns: 1fr;
            }

            .field-full {
                grid-column: auto;
            }
        }

        /* ===== FIX LAYOUT REGISTER SISMENKES ===== */

        /* Lepaskan batas lebar bawaan AdminLTE */
        body.register-page .register-box {
            width: calc(100% - 48px) !important;
            max-width: 1120px !important;
            margin: 24px auto !important;
            float: none !important;
        }

        body.register-page .register-box>.card {
            width: 100% !important;
            margin: 0 !important;
        }

        body.register-page .register-box .card-body {
            width: 100% !important;
            padding: 0 !important;
        }

        /* Pastikan panel dan form memiliki ruang yang proporsional */
        body.register-page .register-modern {
            display: grid !important;
            grid-template-columns: minmax(280px, 0.8fr) minmax(0, 1.2fr) !important;
            width: 100% !important;
            min-width: 0;
            align-items: stretch;
        }

        body.register-page .register-modern .auth-visual,
        body.register-page .register-modern .auth-form-panel {
            min-width: 0;
            width: 100%;
            box-sizing: border-box;
        }

        body.register-page .register-modern .auth-form-panel {
            padding: 42px !important;
        }

        /* Dua kolom input yang benar-benar sejajar */
        body.register-page .register-fields {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            column-gap: 20px !important;
            row-gap: 0 !important;
            width: 100%;
        }

        body.register-page .register-fields .form-group-modern {
            width: 100%;
            min-width: 0;
            margin-bottom: 19px;
        }

        body.register-page .register-fields .field-full {
            grid-column: 1 / -1 !important;
        }

        body.register-page .register-fields .input-icon-wrap {
            width: 100%;
            min-width: 0;
        }

        body.register-page .register-fields .modern-input {
            display: block;
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }

        /* Tablet: tetap dua kolom, tetapi jarak diperkecil */
        @media (min-width: 768px) and (max-width: 991px) {
            body.register-page .register-box {
                width: calc(100% - 24px) !important;
            }

            body.register-page .register-modern {
                grid-template-columns: minmax(220px, 0.7fr) minmax(0, 1.3fr) !important;
            }

            body.register-page .register-modern .auth-form-panel {
                padding: 28px 22px !important;
            }

            body.register-page .register-fields {
                column-gap: 12px !important;
            }
        }

        /* HP: ubah menjadi satu kolom agar tidak berdesakan */
        @media (max-width: 767px) {
            body.register-page .register-box {
                width: calc(100% - 24px) !important;
                max-width: 560px !important;
                margin: 12px auto !important;
            }

            body.register-page .register-modern {
                display: block !important;
            }

            body.register-page .register-modern .auth-visual {
                display: none !important;
            }

            body.register-page .register-modern .auth-form-panel {
                width: 100% !important;
                padding: 28px 22px !important;
            }

            body.register-page .register-fields {
                grid-template-columns: minmax(0, 1fr) !important;
                column-gap: 0 !important;
            }

            body.register-page .register-fields .field-full {
                grid-column: auto !important;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('click', function(event) {
            const button = event.target.closest('.toggle-password');
            if (!button) return;

            const input = document.getElementById(button.dataset.target);
            if (!input) return;

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
