<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_DOKTER = 'dokter';
    public const ROLE_PASIEN = 'pasien';

    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_hp',
        'no_ktp',
        'no_rm',
        'role',
        'id_poli',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function jadwalPeriksa(): HasMany
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    public function daftarPoliSebagaiPasien(): HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }

    public function pemeriksaanSebagaiDokter(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }

    public function pemeriksaanSebagaiPasien(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    public function scopeDokter($query)
    {
        return $query->where('role', self::ROLE_DOKTER);
    }

    public function scopePasien($query)
    {
        return $query->where('role', self::ROLE_PASIEN);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', self::ROLE_ADMIN);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isDokter(): bool
    {
        return $this->role === self::ROLE_DOKTER;
    }

    public function isPasien(): bool
    {
        return $this->role === self::ROLE_PASIEN;
    }
}
