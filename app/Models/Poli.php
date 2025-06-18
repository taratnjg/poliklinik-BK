<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    protected $table = 'poli';

    protected $fillable = ['nama', 'deskripsi'];

    /**
     * Relationship ke model User (dokter)
     * Anggap field foreign key di users adalah id_poli
     */
    public function dokters(): HasMany
    {
        return $this->hasMany(User::class, 'id_poli')
                    ->where('role', 'dokter');
    }
}
