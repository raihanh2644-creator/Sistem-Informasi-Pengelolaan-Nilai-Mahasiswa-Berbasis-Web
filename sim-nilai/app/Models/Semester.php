<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Semester extends Model
{
    protected $table = 'semester';

    protected $fillable = ['tahun_ajaran', 'periode', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    /** Semester yang sedang berjalan (atau null kalau belum ada). */
    public static function saatIni(): ?self
    {
        return static::aktif()->first();
    }
}
