@extends('layouts.app')

@section('subtitle', 'Manajemen Dokter')
@section('content_header_title', 'Manajemen Dokter')
@section('content_header_subtitle', 'Data Tenaga Medis')

@section('content_body')

    <div class="doctor-page">

        {{-- Header halaman --}}
        <div class="doctor-page-header">
            <div>
                <div class="doctor-eyebrow">MANAJEMEN DATA</div>
                <h2>Data Dokter</h2>
                <p>Kelola informasi tenaga medis dan penempatan poli klinik.</p>
            </div>

            <a href="{{ route('admin.dokter.create') }}" class="doctor-primary-btn">
                <i class="fas fa-plus"></i>
                Tambah Dokter
            </a>
        </div>

        {{-- Ringkasan --}}
        <div class="doctor-summary">
            <div class="doctor-summary-icon">
                <i class="fas fa-user-md"></i>
            </div>
            <div>
                <span>Total dokter terdaftar</span>
                <strong>{{ $dokters->count() }}</strong>
                <small>Data tenaga medis dalam sistem</small>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="doctor-alert doctor-alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="doctor-alert doctor-alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Tabel dokter --}}
        <div class="doctor-table-card">

            <div class="doctor-table-heading">
                <div>
                    <h5>Daftar Tenaga Medis</h5>
                    <p>Informasi dokter yang terdaftar di klinik.</p>
                </div>

                <span class="doctor-count">
                    <i class="fas fa-list-ul"></i>
                    {{ $dokters->count() }} data
                </span>
            </div>

            <div class="table-responsive">
                <table class="table doctor-table mb-0">
                    <thead>
                        <tr>
                            <th class="column-number">No.</th>
                            <th>Dokter</th>
                            <th>Kontak</th>
                            <th>Poli</th>
                            <th class="column-action">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($dokters as $dokter)
                            <tr>
                                <td class="number-cell">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="doctor-identity">
                                        <div class="doctor-avatar">
                                            {{ strtoupper(substr($dokter->name ?? 'D', 0, 1)) }}
                                        </div>

                                        <div class="doctor-identity-info">
                                            <strong>{{ $dokter->name }}</strong>
                                            <span>ID Dokter #{{ $dokter->id }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="doctor-contact">
                                        <div>
                                            <i class="far fa-envelope"></i>
                                            <span>{{ $dokter->email }}</span>
                                        </div>

                                        <div>
                                            <i class="fas fa-phone-alt"></i>
                                            <span>{{ $dokter->no_hp ?: 'Nomor belum tersedia' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if ($dokter->poli)
                                        <span class="doctor-poli-badge">
                                            <i class="fas fa-hospital"></i>
                                            {{ $dokter->poli->nama_poli }}
                                        </span>
                                    @else
                                        <span class="doctor-no-poli">Belum ditentukan</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="doctor-actions">
                                        <a href="{{ route('admin.dokter.edit', $dokter->id) }}"
                                            class="doctor-action-btn doctor-edit-btn" title="Edit dokter">
                                            <i class="fas fa-pen"></i>
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter {{ addslashes($dokter->name) }}?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="doctor-action-btn doctor-delete-btn"
                                                title="Hapus dokter">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="doctor-empty-state">
                                        <div class="doctor-empty-icon">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <h6>Belum ada data dokter</h6>
                                        <p>Tambahkan dokter untuk mulai mengelola tenaga medis klinik.</p>

                                        <a href="{{ route('admin.dokter.create') }}" class="doctor-primary-btn">
                                            <i class="fas fa-plus"></i>
                                            Tambah Dokter Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($dokters, 'links') && $dokters->hasPages())
                <div class="doctor-pagination">
                    {{ $dokters->links() }}
                </div>
            @endif

        </div>

    </div>

@stop

@push('css')
    <style>
        .doctor-page {
            color: #29372f;
            font-size: 14px;
        }

        .doctor-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .doctor-eyebrow {
            margin-bottom: 7px;
            color: #52796f;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .doctor-page-header h2 {
            margin: 0 0 7px;
            color: #253b33;
            font-size: 28px;
            font-weight: 800;
        }

        .doctor-page-header p {
            margin: 0;
            color: #657468;
            font-size: 14px;
            line-height: 1.6;
        }

        .doctor-primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 43px;
            padding: 11px 17px;
            border: 1px solid #304b40;
            border-radius: 9px;
            background: #304b40;
            color: #fff !important;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            transition: background .2s, transform .2s;
        }

        .doctor-primary-btn:hover {
            background: #253b33;
            color: #fff;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .doctor-summary {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
            padding: 20px 23px;
            border: 1px solid #dce6d9;
            border-radius: 13px;
            background: linear-gradient(110deg, #e8efe7, #f9faf6);
        }

        .doctor-summary-icon {
            display: flex;
            width: 52px;
            height: 52px;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: #304b40;
            color: #fff;
            font-size: 21px;
        }

        .doctor-summary span,
        .doctor-summary strong,
        .doctor-summary small {
            display: block;
        }

        .doctor-summary span {
            color: #526257;
            font-size: 12px;
            font-weight: 600;
        }

        .doctor-summary strong {
            margin: 3px 0;
            color: #253b33;
            font-size: 28px;
            font-weight: 800;
            line-height: 1.2;
        }

        .doctor-summary small {
            color: #718076;
            font-size: 12px;
        }

        .doctor-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
        }

        .doctor-alert-success {
            border: 1px solid #c8dfce;
            background: #edf6ee;
            color: #346747;
        }

        .doctor-alert-error {
            border: 1px solid #edceca;
            background: #fbefed;
            color: #974c43;
        }

        .doctor-table-card {
            overflow: hidden;
            border: 1px solid #e0e7dd;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 4px 16px rgba(37, 59, 51, .04);
        }

        .doctor-table-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 22px 23px;
            border-bottom: 1px solid #e8ece5;
        }

        .doctor-table-heading h5 {
            margin: 0 0 6px;
            color: #304b40;
            font-size: 17px;
            font-weight: 800;
        }

        .doctor-table-heading p {
            margin: 0;
            color: #718076;
            font-size: 12px;
        }

        .doctor-count {
            padding: 8px 11px;
            border: 1px solid #dce6d9;
            border-radius: 8px;
            background: #f3f7f0;
            color: #426b59;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .doctor-count i {
            margin-right: 5px;
        }

        .doctor-table {
            min-width: 820px;
        }

        .doctor-table thead th {
            padding: 15px 17px;
            border-top: 0;
            border-bottom: 1px solid #e1e8de;
            background: #edf2e9;
            color: #304b40;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .doctor-table tbody td {
            padding: 17px;
            border-top: 1px solid #edf0e9;
            color: #46564a;
            font-size: 13px;
            vertical-align: middle;
        }

        .doctor-table tbody tr {
            transition: background .15s;
        }

        .doctor-table tbody tr:hover {
            background: #fafbf8;
        }

        .doctor-table .column-number {
            width: 60px;
            text-align: center;
        }

        .doctor-table .number-cell {
            color: #7a887b;
            text-align: center;
            font-weight: 600;
        }

        .doctor-identity {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 180px;
        }

        .doctor-avatar {
            display: flex;
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border: 1px solid #d5e3d3;
            border-radius: 12px;
            background: #e8efe7;
            color: #304b40;
            font-size: 17px;
            font-weight: 800;
        }

        .doctor-identity-info strong,
        .doctor-identity-info span {
            display: block;
        }

        .doctor-identity-info strong {
            color: #304b40;
            font-size: 13px;
            font-weight: 750;
        }

        .doctor-identity-info span {
            margin-top: 5px;
            color: #849084;
            font-size: 11px;
        }

        .doctor-contact {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 190px;
        }

        .doctor-contact div {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .doctor-contact i {
            width: 13px;
            color: #789382;
            font-size: 11px;
        }

        .doctor-contact span {
            overflow-wrap: anywhere;
        }

        .doctor-poli-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 10px;
            border: 1px solid #dbe7d8;
            border-radius: 8px;
            background: #f1f6ee;
            color: #426b50;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .doctor-no-poli {
            color: #8c938a;
            font-size: 12px;
        }

        .doctor-table .column-action {
            width: 165px;
        }

        .doctor-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .doctor-actions form {
            margin: 0;
        }

        .doctor-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 34px;
            padding: 7px 9px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s;
        }

        .doctor-edit-btn {
            border-color: #d6e4d3;
            background: #edf4e9;
            color: #426b50;
        }

        .doctor-edit-btn:hover {
            background: #dcebd8;
            color: #304b40;
            text-decoration: none;
        }

        .doctor-delete-btn {
            border-color: #efd9d4;
            background: #fbefed;
            color: #a34d43;
        }

        .doctor-delete-btn:hover {
            background: #f5deda;
            color: #843c34;
        }

        .doctor-empty-state {
            padding: 48px 20px;
            text-align: center;
        }

        .doctor-empty-icon {
            display: flex;
            width: 58px;
            height: 58px;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            border-radius: 16px;
            background: #e8efe7;
            color: #52796f;
            font-size: 23px;
        }

        .doctor-empty-state h6 {
            color: #304b40;
            font-size: 16px;
            font-weight: 800;
        }

        .doctor-empty-state p {
            margin-bottom: 20px;
            color: #718076;
            font-size: 13px;
        }

        .doctor-pagination {
            padding: 17px 22px;
            border-top: 1px solid #e8ece5;
        }

        @media (max-width: 767.98px) {
            .doctor-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .doctor-page-header h2 {
                font-size: 24px;
            }

            .doctor-table-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
@endpush
