<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = ['user_id', 'kelas_id', 'judul', 'isi', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Kosong untuk pengumuman umum. */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function scopeUmum($query)
    {
        return $query->whereNull('kelas_id');
    }
}
