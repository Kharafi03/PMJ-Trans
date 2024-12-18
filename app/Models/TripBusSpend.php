<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripBusSpend extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'trip_bus_spends';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_trip_bus',
        'id_m_spend',
        'description',
        'nominal',
        'kilometer',
        'image_receipt',
        'datetime',
        'latitude',
        'longitude',
    ];

    public function mspend(): BelongsTo
    {
        return $this->belongsTo(MSpend::class, 'id_m_spend');
    }

    public function tripbus(): BelongsTo
    {
        return $this->belongsTo(TripBus::class, 'id_trip_bus');
    }
}
