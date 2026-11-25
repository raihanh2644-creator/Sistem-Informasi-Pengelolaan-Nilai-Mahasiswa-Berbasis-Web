<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = ['kode', 'nama', 'sks'];

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}
