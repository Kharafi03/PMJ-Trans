<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Bus extends Model
{
    use HasFactory;

    // Jika Anda ingin menentukan nama tabel secara eksplisit (opsional)
    protected $table = 'bus';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_bus',
        'plat_nomor',
        'tahun',
        'warna',
        'no_mesin',
        'no_sasis',
        'jumlah_penumpang',
        'bagasi',
        'gambar1',
        'gambar2',
        'gambar3',
        'gambar4',
        'status',
        'is_deleted',
    ];

    const STATUS_OPTIONS = [
        'aktif' => 'Aktif',
        'tidak_aktif' => 'Tidak Aktif',
    ];

    public static function getStatusOptions()
    {
        return self::STATUS_OPTIONS;
    }

    protected $primaryKey = 'id';
    public $incrementing = false; // Disable auto-increment
    protected $keyType = 'string'; // ID is a string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($bus) {
            // Ambil ID terakhir yang ada
            $lastId = DB::table('bus')->max(DB::raw('CAST(SUBSTRING(id, 4) AS UNSIGNED)'));

            // Hitung ID berikutnya
            $nextId = $lastId ? $lastId + 1 : 1;
            $bus->id = 'PMJ' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        });
    }
}
