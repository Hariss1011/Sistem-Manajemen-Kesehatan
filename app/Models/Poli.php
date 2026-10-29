<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokters(): HasMany
    {
        return $this->hasMany(User::class, 'id_poli')
            ->where('role', User::ROLE_DOKTER);
    }
}
