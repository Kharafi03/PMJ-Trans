<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\MoneyCast; // Import MoneyCast
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'trx_id',
        'phone_number',
        'address',
        'total_amount',
        'is_paid',
        'proof',
        'product_id',
        'store_id',
        'duration',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'total_amount' => MoneyCast::class,
        'started_at' => 'date',
        'ended_at' => 'date'
    ];

    public static function generationUniqueTrxId()
    {
        $prefix = 'SEWABUS';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('trx_id', $randomString)->exists());

        return $randomString;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
