@extends('layouts.app')

@section('subtitle', 'Manajemen Pasien')
@section('content_header_title', 'Manajemen Pasien')
@section('content_header_subtitle', 'Data Pasien')

@section('content_body')
    <div class="patient-page">

        {{-- Header halaman --}}
        <div class="patient-hero mb-4">
            <div>
                <span class="patient-eyebrow">
                    <i class="fas fa-hospital-user mr-2"></i> MANAJEMEN DATA
                </span>
                <h2 class="patient-heading">Data Pasien</h2>
                <p class="patient-description">
                    Kelola informasi pasien, identitas, dan nomor rekam medis klinik.
                </p>
            </div>

            <a href="{{ route('admin.pasien.create') }}" class="btn patient-btn-primary">
                <i class="fas fa-plus mr-2"></i> Tambah Pasien
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert patient-alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Ringkasan --}}
        <div class="patient-summary mb-4">
            <div class="patient-summary-icon">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div class="patient-summary-label">Total Data Pasien</div>
                <div class="patient-summary-value">{{ $pasiens->count() }}</div>
                <div class="patient-summary-note">Data pasien yang tersedia dalam daftar ini</div>
            </div>
        </div>

        {{-- Tabel pasien --}}
        <div class="patient-card">
            <div class="patient-card-header">
                <div>
                    <h5>Daftar Pasien</h5>
                    <p>Informasi identitas dan kontak pasien yang terdaftar.</p>
                </div>
                <span class="patient-count">
                    <i class="fas fa-list-ul mr-1"></i>
                    {{ $pasiens->count() }} data
                </span>
            </div>

            <div class="table-responsive">
                <table class="table patient-table mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 55px;">No.</th>
                            <th>Nama Pasien</th>
                            <th>Nomor Rekam Medis</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th class="text-center" style="width: 145px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasiens as $pasien)
                            <tr>
                                <td class="text-center text-muted">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="patient-name-cell">
                                        <div class="patient-avatar">
                                            {{ strtoupper(substr($pasien->name ?? 'P', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="patient-name">{{ $pasien->name }}</div>
                                            <div class="patient-meta">Pasien klinik</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="patient-rm">
                                        {{ $pasien->no_rm ?: 'Belum tersedia' }}
                                    </span>
                                </td>
                                <td>{{ $pasien->email ?: '-' }}</td>
                                <td>{{ $pasien->no_hp ?: '-' }}</td>
                                <td>
                                    <span class="patient-address">
                                        {{ $pasien->alamat ?: 'Belum diisi' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="patient-actions">
                                        <a href="{{ route('admin.pasien.edit', $pasien->id) }}"
                                            class="btn patient-btn-edit" title="Ubah data pasien"
                                            aria-label="Ubah data pasien">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data pasien ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn patient-btn-delete" title="Hapus pasien"
                                                aria-label="Hapus pasien">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="patient-empty">
                                    <div class="patient-empty-icon">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                    <h6>Belum ada data pasien</h6>
                                    <p>Tambahkan data pasien untuk mulai mengelola informasi klinik.</p>
                                    <a href="{{ route('admin.pasien.create') }}" class="btn patient-btn-primary">
                                        <i class="fas fa-plus mr-1"></i> Tambah Pasien
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="patient-card-footer">
                <span>Menampilkan {{ $pasiens->count() }} data pasien</span>
                <span><i class="fas fa-shield-alt mr-1"></i> Data dikelola oleh administrator</span>
            </div>
        </div>
    </div>
@stop

@push('css')
    <style>
        .patient-page {
            color: #29372f;
            font-size: 14px;
        }

        .patient-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 25px 28px;
            background: linear-gradient(115deg, #e8efe7 0%, #f7f7f1 75%);
            border: 1px solid #dce6db;
            border-radius: 16px;
        }

        .patient-eyebrow {
            display: inline-block;
            margin-bottom: 8px;
            color: #52796f;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.3px;
        }

        .patient-heading {
            margin: 0 0 7px;
            color: #253b33;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .patient-description {
            margin: 0;
            color: #59695f;
            font-size: 14px;
            line-height: 1.6;
        }

        .patient-btn-primary {
            padding: 11px 16px;
            color: #fff !important;
            background: #3d6253;
            border: 1px solid #3d6253;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            transition: .2s ease;
        }

        .patient-btn-primary:hover {
            background: #253b33;
            border-color: #253b33;
            transform: translateY(-1px);
        }

        .patient-alert-success {
            color: #285b45;
            background: #e8f3eb;
            border: 1px solid #c9e2d0;
            border-radius: 10px;
        }

        .patient-summary {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 22px;
            background: #fff;
            border: 1px solid #e1e7de;
            border-radius: 13px;
            box-shadow: 0 3px 12px rgba(37, 59, 51, .035);
        }

        .patient-summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            color: #3d7460;
            background: #e5efe5;
            border-radius: 12px;
            font-size: 21px;
        }

        .patient-summary-label {
            color: #59695f;
            font-size: 13px;
            font-weight: 600;
        }

        .patient-summary-value {
            margin-top: 2px;
            color: #253b33;
            font-size: 27px;
            font-weight: 800;
            line-height: 1.25;
        }

        .patient-summary-note {
            margin-top: 3px;
            color: #7b877e;
            font-size: 12px;
        }

        .patient-card {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e1e7de;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(37, 59, 51, .04);
        }

        .patient-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 21px 23px;
            border-bottom: 1px solid #edf0e9;
        }

        .patient-card-header h5 {
            margin: 0 0 5px;
            color: #293f34;
            font-size: 17px;
            font-weight: 800;
        }

        .patient-card-header p {
            margin: 0;
            color: #718076;
            font-size: 13px;
        }

        .patient-count {
            padding: 7px 10px;
            color: #3d6253;
            background: #e8efe7;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .patient-table {
            min-width: 920px;
            color: #435148;
            font-size: 13px;
        }

        .patient-table thead th {
            padding: 14px 15px;
            color: #526459;
            background: #f6f8f3;
            border-top: 0;
            border-bottom: 1px solid #e6eae2;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .45px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .patient-table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-top: 1px solid #eef0eb;
        }

        .patient-table tbody tr {
            transition: background .15s ease;
        }

        .patient-table tbody tr:hover {
            background: #fafbf8;
        }

        .patient-name-cell {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 155px;
        }

        .patient-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            color: #315646;
            background: #e2ede2;
            border: 1px solid #d4e3d4;
            border-radius: 11px;
            font-size: 15px;
            font-weight: 800;
        }

        .patient-name {
            color: #29372f;
            font-size: 13px;
            font-weight: 700;
        }

        .patient-meta {
            margin-top: 3px;
            color: #859087;
            font-size: 11px;
        }

        .patient-rm {
            display: inline-block;
            padding: 5px 8px;
            color: #3d6253;
            background: #eef4ec;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .patient-address {
            display: inline-block;
            max-width: 180px;
            line-height: 1.5;
        }

        .patient-actions {
            display: flex;
            justify-content: center;
            gap: 7px;
        }

        .patient-actions form {
            display: inline-flex;
            margin: 0;
        }

        .patient-btn-edit,
        .patient-btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 8px;
            transition: .2s ease;
        }

        .patient-btn-edit {
            color: #3d6253;
            background: #e8efe7;
            border: 1px solid #d9e5d8;
        }

        .patient-btn-edit:hover {
            color: #fff;
            background: #3d6253;
        }

        .patient-btn-delete {
            color: #a74747;
            background: #fbefed;
            border: 1px solid #f1d8d3;
        }

        .patient-btn-delete:hover {
            color: #fff;
            background: #b94c4c;
        }

        .patient-empty {
            padding: 50px 20px !important;
            text-align: center;
        }

        .patient-empty-icon {
            margin-bottom: 12px;
            color: #91a596;
            font-size: 35px;
        }

        .patient-empty h6 {
            color: #293f34;
            font-size: 16px;
            font-weight: 800;
        }

        .patient-empty p {
            margin-bottom: 18px;
            color: #718076;
            font-size: 13px;
        }

        .patient-card-footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 22px;
            color: #7b877e;
            background: #fcfcfa;
            border-top: 1px solid #edf0e9;
            font-size: 12px;
        }

        @media (max-width: 767.98px) {
            .patient-hero {
                align-items: flex-start;
                flex-direction: column;
                padding: 21px;
            }

            .patient-heading {
                font-size: 23px;
            }

            .patient-card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .patient-card-footer {
                flex-direction: column;
            }
        }
    </style>
@endpush
