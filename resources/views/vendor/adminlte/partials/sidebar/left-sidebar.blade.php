<style>
    .main-sidebar {
        background-color: #304b40 !important;
    }

    .main-sidebar .brand-link {
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .main-sidebar .brand-text {
        color: #f7f7f1;
        font-weight: 700;
        letter-spacing: 0.4px;
    }

    .main-sidebar .user-panel {
        border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
    }

    .main-sidebar .nav-header {
        color: #b9cbbd;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        padding-top: 1.25rem;
    }

    .main-sidebar .nav-sidebar .nav-link {
        color: #e5ece5;
        border-radius: 8px;
        margin: 3px 8px;
        width: auto;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .main-sidebar .nav-sidebar .nav-link .nav-icon {
        color: #c5d5c5;
        font-size: 0.95rem;
        margin-right: 0.35rem;
    }

    .main-sidebar .nav-sidebar .nav-link.active {
        background-color: #c5d5c5 !important;
        color: #253b33 !important;
        font-weight: 600;
        box-shadow: none;
    }

    .main-sidebar .nav-sidebar .nav-link.active .nav-icon {
        color: #253b33 !important;
    }

    .main-sidebar .nav-sidebar .nav-link:hover:not(.active) {
        background-color: rgba(255, 255, 255, 0.09);
        color: #ffffff;
    }

    .main-sidebar .nav-sidebar .nav-link:hover:not(.active) .nav-icon {
        color: #ffffff;
    }

    .main-sidebar .nav-sidebar .nav-link p {
        font-size: 0.88rem;
    }

    .main-sidebar .sidebar-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.12);
        margin-top: 1rem;
        padding-top: 0.75rem;
    }
</style>

<aside class="main-sidebar elevation-2 {{ config('adminlte.classes_sidebar', 'sidebar-dark-success') }}">

    {{-- Brand --}}
    @if (config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    @php
        $user = Auth::user();
        $role = $user->role ?? null;
    @endphp

    <div class="sidebar">

        {{-- Informasi pengguna --}}
        @if ($user)
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <div class="d-flex align-items-center justify-content-center rounded-circle"
                        style="width: 36px; height: 36px; background: #c5d5c5; color: #253b33;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="info">
                    <span class="d-block text-white font-weight-bold">
                        {{ $user->nama ?? ($user->name ?? 'Pengguna') }}
                    </span>

                    <small style="color: #c5d5c5;">
                        {{ ucfirst($role ?? 'Pengguna') }}
                    </small>
                </div>
            </div>
        @endif

        {{-- Navigasi --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- MENU ADMIN --}}
                @if ($role === 'admin')
                    <li class="nav-header">MENU UTAMA</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">MANAJEMEN DATA</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.poli.index') }}"
                            class="nav-link {{ request()->routeIs('admin.poli.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>Data Poli</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dokter.index') }}"
                            class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Data Dokter</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pasien.index') }}"
                            class="nav-link {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.obat.index') }}"
                            class="nav-link {{ request()->routeIs('admin.obat.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Data Obat</p>
                        </a>
                    </li>
                @endif

                {{-- MENU DOKTER --}}
                @if ($role === 'dokter')
                    <li class="nav-header">MENU DOKTER</li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}"
                            class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('jadwal.index') }}"
                            class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Jadwal Periksa</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('memeriksa.index') }}"
                            class="nav-link {{ request()->routeIs('memeriksa.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Memeriksa Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('riwayat.index', [], false) }}"
                            class="nav-link {{ request()->routeIs('riwayat.index', 'riwayat.show', 'riwayat.detail') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Riwayat Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('profil.edit') }}"
                            class="nav-link {{ request()->routeIs('profil.edit', 'dokter.profil.update') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Profil Saya</p>
                        </a>
                    </li>
                @endif

                {{-- MENU PASIEN --}}
                @if ($role === 'pasien')
                    <li class="nav-header">MENU PASIEN</li>

                    <li class="nav-item">
                        <a href="{{ route('pasien.dashboard') }}"
                            class="nav-link {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pasien.poli.index') }}"
                            class="nav-link {{ request()->routeIs('pasien.poli.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Pendaftaran Poli</p>
                        </a>
                    </li>
                @endif

                {{-- AKUN --}}
                <li class="nav-header">AKUN</li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>

                    <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
