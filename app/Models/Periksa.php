<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    protected function casts(): array
    {
        return [
            'tgl_periksa' => 'datetime',
            'biaya_periksa' => 'integer',
        ];
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pasien')
            ->where('role', User::ROLE_PASIEN);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dokter')
            ->where('role', User::ROLE_DOKTER);
    }

    public function daftarPoli(): BelongsTo
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    public function detailPeriksa(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}
