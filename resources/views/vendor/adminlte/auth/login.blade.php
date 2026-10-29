@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')
    <div class="auth-modern">
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
                    <i class="fas fa-shield-alt"></i>
                    LAYANAN KESEHATAN DIGITAL
                </span>

                <h1>Selamat datang kembali.</h1>
                <p>
                    Masuk ke akun Anda untuk mengakses layanan klinik,
                    melihat jadwal dokter, dan memantau informasi pemeriksaan.
                </p>

                <div class="auth-art">
                    <div class="art-circle circle-large"></div>
                    <div class="art-circle circle-small"></div>

                    <div class="art-cross">
                        <span></span>
                        <span></span>
                    </div>

                    <div class="art-heart">
                        <i class="fas fa-heartbeat"></i>
                    </div>

                    <div class="art-caption">
                        <i class="fas fa-check-circle"></i>
                        <span>
                            <strong>Akses lebih praktis</strong>
                            <small>Informasi klinik dalam satu tempat</small>
                        </span>
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
                <span class="form-eyebrow">AKSES AKUN</span>
                <h2>Masuk ke akun Anda</h2>
                <p>Silakan masukkan email dan password untuk melanjutkan.</p>
            </div>

            @if (session('status'))
                <div class="auth-alert auth-alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->has('email') && !$errors->has('password'))
                <div class="auth-alert auth-alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="modern-form">
                @csrf

                <div class="form-group-modern">
                    <label for="email">Alamat Email</label>
                    <div class="input-icon-wrap">
                        <i class="far fa-envelope"></i>
                        <input id="email" type="email" name="email"
                            class="modern-input @error('email') is-invalid @enderror" placeholder="nama@email.com"
                            value="{{ old('email') }}" autocomplete="email" required autofocus>
                    </div>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <div class="label-row">
                        <label for="password">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <div class="input-icon-wrap">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" name="password"
                            class="modern-input @error('password') is-invalid @enderror" placeholder="Masukkan password"
                            autocomplete="current-password" required>
                        <button type="button" class="toggle-password" data-target="password"
                            aria-label="Tampilkan password" aria-pressed="false">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <label class="remember-option" for="remember">
                    <input type="checkbox" id="remember" name="remember" value="1"
                        {{ old('remember') ? 'checked' : '' }}>
                    <span class="custom-check"></span>
                    <span>Ingat saya di perangkat ini</span>
                </label>

                <button type="submit" class="auth-submit">
                    Masuk ke Akun
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="auth-divider"><span>atau</span></div>

            <p class="auth-switch">
                Belum memiliki akun?
                <a href="{{ route('register') }}">Daftar sebagai pasien</a>
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

        body.login-page,
        body.login-page .content-wrapper,
        body.register-page,
        body.register-page .content-wrapper {
            background: var(--auth-ivory) !important;
        }

        body.login-page,
        body.register-page {
            min-height: 100vh;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .login-box,
        .register-box {
            width: min(960px, calc(100% - 32px)) !important;
            max-width: 960px !important;
            margin: 35px auto !important;
        }

        .login-box .card,
        .register-box .card {
            overflow: hidden;
            border: 1px solid rgba(229, 234, 227, .9) !important;
            border-radius: 22px !important;
            background: #fff;
            box-shadow: 0 22px 65px rgba(41, 58, 48, .09) !important;
        }

        .login-box .card-body,
        .register-box .card-body {
            padding: 0 !important;
        }

        .login-box .login-logo,
        .register-box .register-logo,
        .login-box .card-header,
        .register-box .card-header,
        .login-box .card-footer,
        .register-box .card-footer {
            display: none !important;
        }

        .auth-modern {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            min-height: 590px;
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
            margin: 40px 0 25px;
        }

        .visual-badge,
        .form-eyebrow {
            color: var(--auth-green);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.6px;
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
            margin: 20px 0 13px;
            color: #294635;
            font-size: 34px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .visual-content>p {
            margin: 0;
            color: #687c6c;
            font-size: 12px;
            line-height: 1.9;
        }

        .auth-art {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 205px;
            margin-top: 12px;
        }

        .art-circle {
            position: absolute;
            border: 1px solid rgba(66, 107, 88, .18);
            border-radius: 50%;
        }

        .circle-large {
            width: 185px;
            height: 185px;
        }

        .circle-small {
            width: 135px;
            height: 135px;
            border-style: dashed;
        }

        .art-cross {
            position: relative;
            width: 88px;
            height: 88px;
            border-radius: 25px;
            background: var(--auth-green);
            box-shadow: 0 15px 35px rgba(46, 81, 65, .23);
            transform: rotate(-7deg);
        }

        .art-cross span {
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 3px;
            background: #fff;
            transform: translate(-50%, -50%);
        }

        .art-cross span:first-child {
            width: 44px;
            height: 13px;
        }

        .art-cross span:last-child {
            width: 13px;
            height: 44px;
        }

        .art-heart {
            position: absolute;
            right: 25px;
            bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border: 4px solid #e3eddf;
            border-radius: 14px;
            background: #fff;
            color: #b87570;
            font-size: 19px;
        }

        .art-caption {
            position: absolute;
            bottom: -1px;
            left: 0;
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 12px;
            border: 1px solid rgba(255, 255, 255, .8);
            border-radius: 12px;
            background: rgba(255, 255, 255, .82);
            box-shadow: 0 8px 25px rgba(41, 58, 48, .06);
        }

        .art-caption>i {
            color: var(--auth-green);
            font-size: 19px;
        }

        .art-caption strong,
        .art-caption small {
            display: block;
        }

        .art-caption strong {
            color: var(--auth-text);
            font-size: 10px;
        }

        .art-caption small {
            margin-top: 3px;
            color: var(--auth-muted);
            font-size: 9px;
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
            padding: 48px 46px;
        }

        .mobile-brand {
            display: none;
        }

        .form-heading {
            margin-bottom: 29px;
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

        .form-group-modern {
            margin-bottom: 20px;
        }

        .form-group-modern>label,
        .label-row>label {
            display: block;
            margin-bottom: 9px;
            color: #3a4b40;
            font-size: 11px;
            font-weight: 700;
        }

        .label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .label-row>label {
            margin-bottom: 9px;
        }

        .forgot-link {
            margin-bottom: 9px;
            color: var(--auth-green);
            font-size: 10px;
            font-weight: 700;
            text-decoration: none !important;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap>i:first-child {
            position: absolute;
            top: 50%;
            left: 14px;
            z-index: 2;
            color: #849388;
            font-size: 13px;
            transform: translateY(-50%);
        }

        .modern-input {
            display: block;
            width: 100%;
            height: 47px;
            padding: 11px 42px 11px 40px;
            border: 1px solid var(--auth-border);
            border-radius: 10px;
            outline: none;
            background: #fcfdfb;
            color: var(--auth-text);
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
            right: 12px;
            padding: 5px;
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
            margin-top: 6px;
            color: #c44747;
            font-size: 10px;
        }

        .remember-option {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 1px 0 23px;
            color: #68776d;
            font-size: 11px;
            font-weight: 400;
            cursor: pointer;
        }

        .remember-option input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .custom-check {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            border: 1px solid #d5ded5;
            border-radius: 4px;
            background: #fff;
        }

        .remember-option input:checked+.custom-check {
            border-color: var(--auth-green);
            background: var(--auth-green);
        }

        .remember-option input:checked+.custom-check::after {
            content: '\f00c';
            color: #fff;
            font-family: 'Font Awesome 5 Free';
            font-size: 9px;
            font-weight: 900;
        }

        .remember-option input:focus-visible+.custom-check {
            outline: 2px solid #8eb29a;
            outline-offset: 2px;
        }

        .auth-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            min-height: 48px;
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

        .auth-switch a:hover,
        .forgot-link:hover {
            color: var(--auth-green-dark);
            text-decoration: underline !important;
        }

        .back-home {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 25px;
            color: #859087;
            font-size: 10px;
            text-decoration: none !important;
        }

        .back-home:hover {
            color: var(--auth-green);
        }

        .auth-alert {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-bottom: 18px;
            padding: 11px 13px;
            border-radius: 9px;
            font-size: 11px;
            line-height: 1.6;
        }

        .auth-alert-success {
            border: 1px solid #d5e8d8;
            background: #f0f8f0;
            color: #356b43;
        }

        .auth-alert-error {
            border: 1px solid #f0d8d5;
            background: #fff5f3;
            color: #a94442;
        }

        @media (max-width: 767px) {

            .login-box,
            .register-box {
                width: calc(100% - 24px) !important;
                margin: 12px auto !important;
            }

            .login-box .card,
            .register-box .card {
                border-radius: 17px !important;
            }

            .auth-modern {
                display: block;
                min-height: auto;
            }

            .auth-visual {
                display: none;
            }

            .auth-form-panel {
                padding: 30px 24px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 30px;
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
        }

        @media (min-width: 768px) {
            body.login-page .login-box {
                width: min(960px, calc(100% - 40px)) !important;
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
