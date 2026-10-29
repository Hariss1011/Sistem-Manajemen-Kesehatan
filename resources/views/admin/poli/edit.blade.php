@extends('layouts.app')

@section('title', 'Edit Poli')

@section('content_header_title', 'Manajemen Poli')
@section('content_header_subtitle', 'Edit Poli')

@section('content_body')
    <div class="container-fluid px-0">

        <div class="mb-4">
            <div class="text-uppercase font-weight-bold mb-2" style="font-size: 11px; letter-spacing: 1.5px; color: #688f80;">
                Administrasi Klinik
            </div>

            <h2 class="font-weight-bold mb-1" style="color: #304b40; font-size: 28px;">
                Edit Informasi Poli
            </h2>

            <p class="mb-0" style="color: #7b877e; font-size: 14px;">
                Perbarui informasi poli tanpa membuat data baru.
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                <div class="font-weight-bold mb-1">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Periksa kembali isian Anda.
                </div>
                <ul class="mb-0 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm"
                    style="border-radius: 13px; border: 1px solid #e6e9e1 !important; overflow: hidden;">

                    <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center mr-3"
                                style="width: 46px; height: 46px; border-radius: 12px; background: #e8efe7; color: #3d6253;">
                                <i class="fas fa-edit fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mb-1" style="color: #304b40;">
                                    {{ $poli->nama_poli }}
                                </h5>
                                <p class="mb-0" style="font-size: 13px; color: #7b877e;">
                                    Perbarui detail unit pelayanan kesehatan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">
                        <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST">
                            @method('PUT')
                            @include('admin.poli.form')
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xl-5 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm" style="border-radius: 13px; border: 1px solid #e6e9e1 !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle mr-2" style="color: #688f80;"></i>
                            <h6 class="font-weight-bold mb-0" style="color: #304b40;">
                                Informasi Perubahan
                            </h6>
                        </div>

                        <p class="mb-3" style="color: #68766c; font-size: 13px; line-height: 1.8;">
                            Anda sedang mengubah informasi poli yang sudah terdaftar. Pastikan nama dan keterangannya sesuai
                            dengan layanan yang tersedia.
                        </p>

                        <div class="p-3" style="background: #f7f7f1; border-radius: 9px;">
                            <div class="mb-1"
                                style="font-size: 11px; text-transform: uppercase; letter-spacing: .7px; color: #7b877e;">
                                Nama saat ini
                            </div>
                            <div class="font-weight-bold" style="font-size: 15px; color: #304b40;">
                                {{ $poli->nama_poli }}
                            </div>
                        </div>

                        <div class="mt-3" style="font-size: 12px; color: #7b877e; line-height: 1.7;">
                            <i class="fas fa-shield-alt mr-1" style="color: #688f80;"></i>
                            Periksa kembali perubahan sebelum menyimpannya.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
