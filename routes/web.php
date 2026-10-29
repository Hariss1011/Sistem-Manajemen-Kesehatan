
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\MemeriksaPasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfilDokterController;
use App\Http\Controllers\RiwayatPasienController;
use App\Http\Controllers\PeriksaController;
/*
|--------------------------------------------------------------------------
| Halaman Umum
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Route Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('poli', PoliController::class);
    Route::resource('obat', ObatController::class);
});

/*
|--------------------------------------------------------------------------
| Route Dokter
|--------------------------------------------------------------------------
*/

Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');

    // Jadwal praktik dokter
    Route::resource('jadwal', JadwalPeriksaController::class)->only(['index', 'create', 'store', 'edit', 'update']);

    // Pemeriksaan pasien
    Route::get('/memeriksa', [MemeriksaPasienController::class, 'index'])->name('memeriksa.index');
    Route::get('/memeriksa/{id}', [MemeriksaPasienController::class, 'show'])->whereNumber('id')->name('memeriksa.show');
    Route::get('/memeriksa/{id}/edit', [MemeriksaPasienController::class, 'edit'])->whereNumber('id')->name('memeriksa.edit');
    Route::put('/memeriksa/{id}', [MemeriksaPasienController::class, 'update'])->whereNumber('id')->name('memeriksa.update');
    // Riwayat pasien
    Route::get('/riwayat-pasien', [RiwayatPasienController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat-pasien/{id}', [RiwayatPasienController::class, 'show'])->whereNumber('id')->name('riwayat.show');
    Route::get('/riwayat/detail/{id}', [RiwayatPasienController::class, 'detail'])->whereNumber('id')->name('riwayat.detail');

    // Profil dokter
    Route::get('/profil', [ProfilDokterController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilDokterController::class, 'update'])->name('dokter.profil.update');
});

/*
|--------------------------------------------------------------------------
| Route Pasien
|--------------------------------------------------------------------------
*/

Route::prefix('pasien')->name('pasien.')->middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/', [DashboardPasienController::class, 'index'])->name('dashboard');
    // Pendaftaran poli
    Route::get('/poli', [DaftarPoliController::class, 'index'])->name('poli.index');
    Route::post('/poli', [DaftarPoliController::class, 'store'])->name('poli.store');
    Route::delete('/poli/{id}', [DaftarPoliController::class, 'destroy'])->whereNumber('id')->name('poli.destroy');
    Route::get('/poli/{id}/detail', [DaftarPoliController::class, 'detail'])
        ->whereNumber('id')
        ->name('poli.detail');

    // Data jadwal dokter berdasarkan poli
    Route::get('/jadwal-periksa/poli/{id}', [DaftarPoliController::class, 'getJadwalByPoli'])->whereNumber('id')->name('jadwal.poli');

    Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa.index');
});

/*
|--------------------------------------------------------------------------
| Endpoint Jadwal untuk Form Pendaftaran
|--------------------------------------------------------------------------
|
| URL lama dipertahankan untuk menghindari kerusakan
| pada JavaScript atau view yang sudah menggunakannya.
| Endpoint ini tetap khusus pasien yang sudah login.
|
*/

Route::get('/jadwal-periksa/poli/{id}', [JadwalPeriksaController::class, 'getJadwalByPoli'])
    ->whereNumber('id')
    ->middleware(['auth', 'role:pasien'])
    ->name('jadwal-periksa.poli');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/

Auth::routes();
