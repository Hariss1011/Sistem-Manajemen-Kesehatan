<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPeriksa extends Model
{
    use HasFactory;

    public const STATUS_AKTIF = 'Aktif';
    public const STATUS_TIDAK_AKTIF = 'Tidak Aktif';

    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dokter')
            ->where('role', User::ROLE_DOKTER);
    }

    public function daftarPoli(): HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', self::STATUS_AKTIF);
    }

    public function scopePadaHari($query, string $hari)
    {
        return $query->where('hari', $hari);
    }
}
