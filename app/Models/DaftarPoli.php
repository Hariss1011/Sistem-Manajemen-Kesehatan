<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DaftarPoli extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'tanggal_kunjungan',
        'keluhan',
        'no_antrian',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kunjungan' => 'date',
            'no_antrian' => 'integer',
        ];
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pasien')
            ->where('role', User::ROLE_PASIEN);
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    /**
     * Alias untuk kode lama yang menggunakan jadwalPeriksa().
     */
    public function jadwalPeriksa(): BelongsTo
    {
        return $this->jadwal();
    }

    public function periksa(): HasOne
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}
