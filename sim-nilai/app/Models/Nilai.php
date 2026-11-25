<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = ['krs_id', 'tugas', 'uts', 'uas'];

    // ASUMSI bobot dan skala grade, sesuaikan dengan aturan kampus.
    public const BOBOT_TUGAS = 0.30;
    public const BOBOT_UTS   = 0.30;
    public const BOBOT_UAS   = 0.40;

    protected $casts = [
        'tugas'       => 'decimal:2',
        'uts'         => 'decimal:2',
        'uas'         => 'decimal:2',
        'nilai_akhir' => 'decimal:2',
    ];

    /** Nilai akhir dan grade dihitung otomatis setiap kali nilai disimpan. */
    protected static function booted(): void
    {
        static::saving(function (Nilai $nilai) {
            $nilai->hitung();
        });
    }

    public function krs(): BelongsTo
    {
        return $this->belongsTo(Krs::class);
    }

    public function hitung(): void
    {
        if ($this->tugas === null || $this->uts === null || $this->uas === null) {
            $this->nilai_akhir = null;
            $this->grade = null;
            return;
        }

        $this->nilai_akhir = round(
            $this->tugas * self::BOBOT_TUGAS
            + $this->uts * self::BOBOT_UTS
            + $this->uas * self::BOBOT_UAS,
            2
        );
        $this->grade = self::konversiGrade((float) $this->nilai_akhir);
    }

    public static function konversiGrade(float $nilaiAkhir): string
    {
        return match (true) {
            $nilaiAkhir >= 80 => 'A',
            $nilaiAkhir >= 70 => 'B',
            $nilaiAkhir >= 60 => 'C',
            default           => 'D',
        };
    }

    /** Angka mutu untuk menghitung IPS/IPK (A=4, B=3, C=2, D=1). */
    public function getMutuAttribute(): ?int
    {
        return match ($this->grade) {
            'A' => 4,
            'B' => 3,
            'C' => 2,
            'D' => 1,
            default => null,
        };
    }
}
