@extends('layouts.app')

@section('title', 'Tambah Poli')

@section('content_header_title', 'Manajemen Poli')
@section('content_header_subtitle', 'Tambah Poli')

@section('content_body')
    <div class="container-fluid px-0">

        <div class="mb-4">
            <div class="text-uppercase font-weight-bold mb-2" style="font-size: 11px; letter-spacing: 1.5px; color: #688f80;">
                Administrasi Klinik
            </div>

            <h2 class="font-weight-bold mb-1" style="color: #304b40; font-size: 28px;">
                Tambah Poli Baru
            </h2>

            <p class="mb-0" style="color: #7b877e; font-size: 14px;">
                Daftarkan unit pelayanan kesehatan baru ke dalam sistem klinik.
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
                                <i class="fas fa-hospital-alt fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mb-1" style="color: #304b40;">
                                    Informasi Poli
                                </h5>
                                <p class="mb-0" style="font-size: 13px; color: #7b877e;">
                                    Lengkapi informasi unit pelayanan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-4 pt-3 pb-4">
                        <form action="{{ route('admin.poli.store') }}" method="POST">
                            @include('admin.poli.form')
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xl-5 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm"
                    style="border-radius: 13px; background: #e8efe7; border: 1px solid #dce7da !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-lightbulb mr-2" style="color: #3d6253;"></i>
                            <h6 class="font-weight-bold mb-0" style="color: #304b40;">
                                Panduan Pengisian
                            </h6>
                        </div>

                        <div class="mb-3">
                            <div class="font-weight-bold mb-1" style="color: #304b40; font-size: 13px;">
                                Nama poli
                            </div>
                            <p class="mb-0" style="color: #526257; font-size: 13px; line-height: 1.7;">
                                Gunakan nama yang sesuai dengan layanan klinik, misalnya Poli Umum atau Poli Gigi.
                            </p>
                        </div>

                        <div>
                            <div class="font-weight-bold mb-1" style="color: #304b40; font-size: 13px;">
                                Keterangan layanan
                            </div>
                            <p class="mb-0" style="color: #526257; font-size: 13px; line-height: 1.7;">
                                Tambahkan deskripsi singkat untuk membantu menjelaskan layanan yang tersedia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
