@extends('layouts.app')

@section('title', 'Jadwal Periksa')

@section('content')
    <style>
        .schedule-page {
            color: #29372f;
            font-size: 14px;
        }

        .schedule-page .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .schedule-page .page-title {
            margin: 0 0 6px;
            font-size: 26px;
            font-weight: 800;
            color: #29372f;
        }

        .schedule-page .page-description {
            margin: 0;
            color: #7b877e;
            font-size: 13px;
        }

        .schedule-page .btn-add {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 11px 16px;
            border: 0;
            border-radius: 10px;
            background: #3d6253;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background .2s, transform .2s;
        }

        .schedule-page .btn-add:hover {
            color: #fff;
            background: #304b40;
            transform: translateY(-1px);
        }

        .schedule-page .summary-card {
            display: flex;
            align-items: center;
            gap: 15px;
            height: 100%;
            min-height: 112px;
            padding: 20px;
            border: 1px solid #e6e9e1;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(41, 55, 47, .035);
        }

        .schedule-page .summary-icon {
            display: flex;
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            font-size: 19px;
        }

        .schedule-page .summary-icon.total {
            color: #3d6253;
            background: #e8efe7;
        }

        .schedule-page .summary-icon.active {
            color: #28744f;
            background: #e3f4e9;
        }

        .schedule-page .summary-icon.inactive {
            color: #8b6b35;
            background: #faf0dd;
        }

        .schedule-page .summary-label {
            margin: 0 0 5px;
            color: #68766c;
            font-size: 12px;
            font-weight: 600;
        }

        .schedule-page .summary-value {
            margin: 0;
            color: #29372f;
            font-size: 27px;
            font-weight: 800;
            line-height: 1.2;
        }

        .schedule-page .table-panel {
            overflow: hidden;
            border: 1px solid #e6e9e1;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(41, 55, 47, .035);
        }

        .schedule-page .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 21px 23px;
            border-bottom: 1px solid #edf0ea;
        }

        .schedule-page .panel-title {
            margin: 0 0 5px;
            color: #29372f;
            font-size: 16px;
            font-weight: 750;
        }

        .schedule-page .panel-subtitle {
            margin: 0;
            color: #7b877e;
            font-size: 12px;
        }

        .schedule-page .count-chip {
            padding: 7px 11px;
            border-radius: 8px;
            background: #e8efe7;
            color: #3d6253;
            font-size: 12px;
            font-weight: 700;
        }

        .schedule-page .table-responsive {
            width: 100%;
        }

        .schedule-page .schedule-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .schedule-page .schedule-table thead th {
            padding: 14px 17px;
            border: 0;
            border-bottom: 1px solid #e6e9e1;
            background: #f7f8f4;
            color: #68766c;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .45px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .schedule-page .schedule-table tbody td {
            padding: 17px;
            border: 0;
            border-bottom: 1px solid #edf0ea;
            color: #536157;
            font-size: 13px;
            vertical-align: middle;
        }

        .schedule-page .schedule-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .schedule-page .schedule-table tbody tr {
            transition: background .15s ease;
        }

        .schedule-page .schedule-table tbody tr:hover {
            background: #fafbf8;
        }

        .schedule-page .number-cell {
            color: #9aa49b !important;
            font-weight: 700;
        }

        .schedule-page .day-cell {
            color: #29372f !important;
            font-weight: 750;
        }

        .schedule-page .time-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 9px;
            border-radius: 8px;
            background: #f1f5ef;
            color: #3d6253;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .schedule-page .status-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .schedule-page .status-chip::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .schedule-page .status-active {
            color: #28744f;
            background: #e3f4e9;
        }

        .schedule-page .status-inactive {
            color: #7b817b;
            background: #eef0ed;
        }

        .schedule-page .btn-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 11px;
            border: 1px solid #dce7dc;
            border-radius: 8px;
            background: #fff;
            color: #3d6253;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: background .2s, border-color .2s;
        }

        .schedule-page .btn-edit:hover {
            border-color: #52796f;
            background: #f1f5ef;
            color: #304b40;
        }

        .schedule-page .empty-state {
            padding: 48px 20px;
            text-align: center;
        }

        .schedule-page .empty-icon {
            display: flex;
            width: 62px;
            height: 62px;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            border-radius: 18px;
            background: #e8efe7;
            color: #52796f;
            font-size: 25px;
        }

        .schedule-page .empty-title {
            margin: 0 0 7px;
            color: #29372f;
            font-size: 16px;
            font-weight: 750;
        }

        .schedule-page .empty-description {
            max-width: 360px;
            margin: 0 auto 18px;
            color: #7b877e;
            font-size: 13px;
            line-height: 1.7;
        }

        @media (max-width: 767.98px) {
            .schedule-page .page-title {
                font-size: 23px;
            }

            .schedule-page .btn-add {
                width: 100%;
            }

            .schedule-page .panel-header {
                padding: 18px;
            }

            .schedule-page .schedule-table thead th,
            .schedule-page .schedule-table tbody td {
                padding: 13px;
            }
        }
    </style>

    @php
        $jumlahJadwal = $jadwals->count();
        $jumlahAktif = $jadwals->where('status', 'Aktif')->count();
        $jumlahTidakAktif = $jadwals->where('status', 'Tidak Aktif')->count();
    @endphp

    <div class="schedule-page">
        <div class="page-heading">
            <div>
                <h1 class="page-title">Jadwal Periksa</h1>
                <p class="page-description">
                    Kelola hari dan jam praktik Anda di SISMENKES.
                </p>
            </div>

            <a href="{{ route('jadwal.create') }}" class="btn-add">
                <i class="fas fa-plus"></i>
                Tambah Jadwal
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <div class="summary-card">
                    <div class="summary-icon total">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div>
                        <p class="summary-label">Total Jadwal</p>
                        <h2 class="summary-value">{{ $jumlahJadwal }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <div class="summary-card">
                    <div class="summary-icon active">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="summary-label">Jadwal Aktif</p>
                        <h2 class="summary-value">{{ $jumlahAktif }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="summary-card">
                    <div class="summary-icon inactive">
                        <i class="fas fa-pause-circle"></i>
                    </div>
                    <div>
                        <p class="summary-label">Jadwal Tidak Aktif</p>
                        <h2 class="summary-value">{{ $jumlahTidakAktif }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Daftar Jadwal Praktik</h2>
                    <p class="panel-subtitle">
                        Daftar hari praktik beserta waktu dan statusnya.
                    </p>
                </div>

                <span class="count-chip">
                    {{ $jumlahJadwal }} jadwal
                </span>
            </div>

            @if ($jadwals->count())
                <div class="table-responsive">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Hari Praktik</th>
                                <th>Dokter</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $index => $j)
                                <tr>
                                    <td class="number-cell">{{ $index + 1 }}</td>

                                    <td class="day-cell">{{ $j->hari }}</td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2"
                                                style="
                                                display:flex;
                                                width:34px;
                                                height:34px;
                                                align-items:center;
                                                justify-content:center;
                                                border-radius:10px;
                                                background:#e8efe7;
                                                color:#3d6253;
                                            ">
                                                <i class="fas fa-user-md"></i>
                                            </span>
                                            <span style="font-weight:600;color:#29372f;">
                                                {{ auth()->user()->name }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="time-chip">
                                            <i class="far fa-clock"></i>
                                            {{ \Illuminate\Support\Str::of($j->jam_mulai)->limit(5, '') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="time-chip">
                                            <i class="far fa-clock"></i>
                                            {{ \Illuminate\Support\Str::of($j->jam_selesai)->limit(5, '') }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($j->status === 'Aktif')
                                            <span class="status-chip status-active">Aktif</span>
                                        @else
                                            <span class="status-chip status-inactive">Tidak Aktif</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('jadwal.edit', $j->id) }}" class="btn-edit">
                                            <i class="fas fa-pen"></i>
                                            Ubah Status
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="far fa-calendar-plus"></i>
                    </div>
                    <h3 class="empty-title">Belum Ada Jadwal Praktik</h3>
                    <p class="empty-description">
                        Anda belum memiliki jadwal praktik. Tambahkan jadwal agar
                        hari dan jam praktik Anda dapat dikelola melalui sistem.
                    </p>
                    <a href="{{ route('jadwal.create') }}" class="btn-add">
                        <i class="fas fa-plus"></i>
                        Tambah Jadwal Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
