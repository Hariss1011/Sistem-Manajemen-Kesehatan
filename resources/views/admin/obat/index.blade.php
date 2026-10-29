@extends('layouts.app')

@section('title', 'Manajemen Obat')

@section('content_header_title', 'Manajemen Obat')
@section('content_header_subtitle', 'Daftar Obat')

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
                    Manajemen Obat
                </h2>
                <p class="mb-0" style="color: #7b877e; font-size: 14px;">
                    Kelola informasi obat, kemasan, dan harga yang tercatat dalam sistem.
                </p>
            </div>

            <a href="{{ route('admin.obat.create') }}" class="btn shadow-sm px-4 py-2"
                style="background: #3d6253; color: #fff; border-radius: 9px; font-weight: 600;">
                <i class="fas fa-plus mr-2"></i> Tambah Obat
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert border-0 shadow-sm mb-4" style="border-radius: 10px; background: #e8efe7; color: #304b40;">
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

        {{-- Ringkasan data --}}
        <div class="row mb-4">
            <div class="col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm h-100"
                    style="border-radius: 13px; border: 1px solid #e6e9e1 !important;">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="d-flex align-items-center justify-content-center mr-3"
                            style="width: 52px; height: 52px; border-radius: 13px; background: #e2f0e9; color: #3d7965;">
                            <i class="fas fa-pills fa-lg"></i>
                        </div>
                        <div>
                            <div class="mb-1" style="font-size: 13px; color: #68766c;">
                                Total Jenis Obat
                            </div>
                            <div class="font-weight-bold" style="font-size: 28px; line-height: 1.2; color: #304b40;">
                                {{ $obats->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-4 mt-3 mt-sm-0">
                <div class="card border-0 shadow-sm h-100"
                    style="border-radius: 13px; border: 1px solid #e6e9e1 !important;">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="d-flex align-items-center justify-content-center mr-3"
                            style="width: 52px; height: 52px; border-radius: 13px; background: #f5edda; color: #98753d;">
                            <i class="fas fa-tags fa-lg"></i>
                        </div>
                        <div>
                            <div class="mb-1" style="font-size: 13px; color: #68766c;">
                                Harga Tertinggi
                            </div>
                            <div class="font-weight-bold" style="font-size: 23px; line-height: 1.3; color: #304b40;">
                                Rp {{ number_format($obats->max('harga') ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel obat --}}
        <div class="card border-0 shadow-sm"
            style="border-radius: 13px; border: 1px solid #e6e9e1 !important; overflow: hidden;">

            <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                    <div>
                        <h5 class="font-weight-bold mb-1" style="color: #304b40;">
                            <i class="fas fa-prescription-bottle-alt mr-2" style="color: #688f80;"></i>
                            Daftar Obat
                        </h5>
                        <p class="mb-0" style="font-size: 13px; color: #7b877e;">
                            Informasi obat yang tersedia dalam data klinik.
                        </p>
                    </div>
                    <span class="badge mt-3 mt-md-0 px-3 py-2"
                        style="background: #e8efe7; color: #3d6253; border-radius: 20px; font-size: 12px;">
                        {{ $obats->count() }} data
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
                                    Nama Obat
                                </th>
                                <th class="py-3 border-top-0"
                                    style="font-size: 11px; color: #65776b; text-transform: uppercase; letter-spacing: .7px;">
                                    Kemasan
                                </th>
                                <th class="py-3 border-top-0"
                                    style="font-size: 11px; color: #65776b; text-transform: uppercase; letter-spacing: .7px;">
                                    Harga
                                </th>
                                <th class="px-4 py-3 border-top-0 text-right"
                                    style="font-size: 11px; color: #65776b; text-transform: uppercase; letter-spacing: .7px; width: 155px;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($obats as $obat)
                                <tr>
                                    <td class="px-4 py-3 align-middle" style="color: #7b877e; font-size: 13px;">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center justify-content-center mr-3"
                                                style="width: 40px; height: 40px; flex-shrink: 0; border-radius: 10px; background: #e2f0e9; color: #3d7965;">
                                                <i class="fas fa-pills"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold" style="color: #304b40; font-size: 14px;">
                                                    {{ $obat->nama_obat }}
                                                </div>
                                                <div style="font-size: 12px; color: #89938b;">
                                                    Data farmasi klinik
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-3 align-middle" style="font-size: 13px; color: #68766c;">
                                        <span class="d-inline-block px-2 py-1"
                                            style="background: #f0f2ec; border-radius: 6px; color: #526257;">
                                            {{ $obat->kemasan }}
                                        </span>
                                    </td>

                                    <td class="py-3 align-middle">
                                        <span class="font-weight-bold" style="font-size: 14px; color: #304b40;">
                                            Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 align-middle text-right">
                                        <div class="d-inline-flex align-items-center">
                                            <a href="{{ route('admin.obat.edit', $obat->id) }}" class="btn btn-sm mr-2"
                                                title="Edit obat"
                                                style="border-radius: 7px; background: #e8efe7; color: #3d6253; font-weight: 600;">
                                                <i class="fas fa-pen mr-1"></i> Ubah
                                            </a>

                                            <form action="{{ route('admin.obat.destroy', $obat->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat {{ addslashes($obat->nama_obat) }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" title="Hapus obat"
                                                    style="border-radius: 7px; background: #fbe9e7; color: #a94442; font-weight: 600;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="mb-3 mx-auto d-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px; border-radius: 18px; background: #e2f0e9; color: #3d7965;">
                                            <i class="fas fa-pills fa-2x"></i>
                                        </div>
                                        <h6 class="font-weight-bold mb-1" style="color: #304b40;">
                                            Belum ada data obat
                                        </h6>
                                        <p class="mb-3" style="font-size: 13px; color: #7b877e;">
                                            Tambahkan data obat pertama untuk mulai mengelola informasi farmasi.
                                        </p>
                                        <a href="{{ route('admin.obat.create') }}" class="btn btn-sm px-3"
                                            style="background: #3d6253; color: #fff; border-radius: 7px;">
                                            <i class="fas fa-plus mr-1"></i> Tambah Obat
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
                Pastikan nama, kemasan, dan harga obat tercatat dengan benar.
            </div>
        </div>
    </div>
@stop
