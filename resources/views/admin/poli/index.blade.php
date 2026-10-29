@extends('layouts.app')

@section('title', 'Manajemen Poli')

@section('content_header_title', 'Manajemen Poli')
@section('content_header_subtitle', 'Daftar Poli')

@section('content_body')
    <div class="container-fluid px-0">

        {{-- Header halaman --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div class="mb-3 mb-md-0">
                <div class="text-uppercase font-weight-bold mb-2"
                    style="font-size: 11px; letter-spacing: 1.5px; color: #688f80;">
                    Administrasi Klinik
                </div>
                <h2 class="font-weight-bold mb-1" style="color: #304b40; font-size: 28px;">
                    Manajemen Poli
                </h2>
                <p class="mb-0" style="color: #7b877e; font-size: 14px;">
                    Kelola daftar poli dan informasi layanan kesehatan klinik.
                </p>
            </div>

            <a href="{{ route('admin.poli.create') }}" class="btn shadow-sm px-4 py-2"
                style="background: #3d6253; color: #fff; border-radius: 9px; font-weight: 600;">
                <i class="fas fa-plus mr-2"></i> Tambah Poli
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4"
                style="border-radius: 10px; background: #e8efe7; color: #304b40;">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                <div class="font-weight-bold mb-1">Terjadi kesalahan</div>
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Ringkasan --}}
        <div class="row mb-4">
            <div class="col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm h-100"
                    style="border-radius: 13px; border: 1px solid #e6e9e1 !important;">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="d-flex align-items-center justify-content-center mr-3"
                            style="width: 52px; height: 52px; border-radius: 13px; background: #e8efe7; color: #3d6253;">
                            <i class="fas fa-hospital-alt fa-lg"></i>
                        </div>
                        <div>
                            <div class="mb-1" style="font-size: 13px; color: #7b877e;">
                                Total Poli Terdaftar
                            </div>
                            <div class="font-weight-bold" style="font-size: 27px; line-height: 1.2; color: #304b40;">
                                {{ $polis->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel data --}}
        <div class="card border-0 shadow-sm"
            style="border-radius: 13px; border: 1px solid #e6e9e1 !important; overflow: hidden;">

            <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                    <div>
                        <h5 class="font-weight-bold mb-1" style="color: #304b40;">
                            <i class="fas fa-list-ul mr-2" style="color: #688f80;"></i>
                            Daftar Poli
                        </h5>
                        <p class="mb-0" style="font-size: 13px; color: #7b877e;">
                            Informasi poli yang tersedia di klinik.
                        </p>
                    </div>
                    <span class="badge mt-3 mt-md-0 px-3 py-2"
                        style="background: #e8efe7; color: #3d6253; border-radius: 20px; font-size: 12px;">
                        {{ $polis->count() }} data
                    </span>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr style="background: #f7f7f1;">
                                <th class="px-4 py-3 border-top-0"
                                    style="font-size: 11px; color: #65776b; text-transform: uppercase; letter-spacing: .7px; width: 75px;">
                                    No.
                                </th>
                                <th class="py-3 border-top-0"
                                    style="font-size: 11px; color: #65776b; text-transform: uppercase; letter-spacing: .7px;">
                                    Nama Poli
                                </th>
                                <th class="py-3 border-top-0"
                                    style="font-size: 11px; color: #65776b; text-transform: uppercase; letter-spacing: .7px;">
                                    Keterangan
                                </th>
                                <th class="px-4 py-3 border-top-0 text-right"
                                    style="font-size: 11px; color: #65776b; text-transform: uppercase; letter-spacing: .7px; width: 150px;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($polis as $poli)
                                <tr>
                                    <td class="px-4 py-3 align-middle" style="color: #7b877e; font-size: 13px;">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center justify-content-center mr-3"
                                                style="width: 40px; height: 40px; flex-shrink: 0; border-radius: 10px; background: #e8efe7; color: #3d6253;">
                                                <i class="fas fa-stethoscope"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold" style="color: #304b40; font-size: 14px;">
                                                    {{ $poli->nama_poli }}
                                                </div>
                                                <div style="font-size: 12px; color: #89938b;">
                                                    Unit pelayanan kesehatan
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 align-middle"
                                        style="font-size: 13px; color: #68766c; min-width: 220px;">
                                        {{ $poli->keterangan ?: 'Belum ada keterangan' }}
                                    </td>
                                    <td class="px-4 py-3 align-middle text-right">
                                        <div class="d-inline-flex align-items-center">
                                            <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-sm mr-2"
                                                title="Edit poli"
                                                style="border-radius: 7px; background: #e8efe7; color: #3d6253; font-weight: 600;">
                                                <i class="fas fa-pen mr-1"></i> Ubah
                                            </a>

                                            <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus poli {{ addslashes($poli->nama_poli) }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" title="Hapus poli"
                                                    style="border-radius: 7px; background: #fbe9e7; color: #a94442; font-weight: 600;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="mb-3 mx-auto d-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px; border-radius: 18px; background: #e8efe7; color: #688f80;">
                                            <i class="fas fa-hospital-alt fa-2x"></i>
                                        </div>
                                        <h6 class="font-weight-bold mb-1" style="color: #304b40;">
                                            Belum ada data poli
                                        </h6>
                                        <p class="mb-3" style="font-size: 13px; color: #7b877e;">
                                            Tambahkan poli pertama untuk mulai mengelola layanan klinik.
                                        </p>
                                        <a href="{{ route('admin.poli.create') }}" class="btn btn-sm px-3"
                                            style="background: #3d6253; color: white; border-radius: 7px;">
                                            <i class="fas fa-plus mr-1"></i> Tambah Poli
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer px-4 py-3"
                style="background: #fff; border-top: 1px solid #edf0e9; color: #7b877e; font-size: 12px;">
                <i class="fas fa-info-circle mr-1" style="color: #688f80;"></i>
                Data poli digunakan dalam pengelolaan dokter dan pendaftaran pasien.
            </div>
        </div>
    </div>
@stop
