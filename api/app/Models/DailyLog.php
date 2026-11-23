<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DailyLog extends Model
{
    /**
     * Kolom yang boleh diisi lewat create() atau update().
     * 'uuid' dan 'user_id' sengaja tidak dimasukkan: uuid dibuat otomatis,
     * user_id diambil dari pengguna yang sedang login.
     */
    protected $fillable = [
        'log_date',
        'stress_level',
        'ate_breakfast',
        'ate_lunch',
        'ate_dinner',
        'symptoms',
        'symptom_severity',
        'triggers',
        'note',
        'photo_path',
    ];

    /**
     * Mengubah tipe data otomatis saat dibaca dari dan disimpan ke database.
     */
    protected function casts(): array
    {
        return [
            'log_date' => 'date',
            'ate_breakfast' => 'boolean',
            'ate_lunch' => 'boolean',
            'ate_dinner' => 'boolean',
            'symptoms' => 'array',
            'triggers' => 'array',
        ];
    }

    /**
     * Dijalankan sekali saat model dibuat: isi kolom uuid secara otomatis.
     */
    protected static function booted(): void
    {
        static::creating(function (DailyLog $log) {
            $log->uuid = (string) Str::uuid();
        });
    }

    /**
     * Alamat API memakai uuid, bukan id urut, supaya tidak mudah ditebak.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}