<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = ['kelas_id', 'mahasiswa_id', 'pertemuan_ke', 'tanggal', 'status'];

    public const STATUS = ['hadir', 'izin', 'sakit', 'alpa'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
