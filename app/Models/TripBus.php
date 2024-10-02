<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripBus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trip_buses';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_booking',
        'id_bus',
        'id_customer',
        'id_driver',
        'id_codriver',
        'nominal',
        'km_start',
        'km_end',
        'id_ms_trip',
        'total_spend',
        'total_spend_bbm',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }

    public function cus(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_driver');
    }

    public function codriver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_codriver');
    }

    public function tripbusspend()
    {
        return $this->hasMany(TripBusSpend::class, 'id_trip_bus');
    }

    public function ms_trip()
    {
        return $this->belongsTo(MsTrip::class, 'id_ms_trip');
    }

    // public function ()
    // {
    //     return $this->hasMany(Outcome::class, 'id_booking');
    // }
}
