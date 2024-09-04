<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'bookings';

    protected $fillable = [
        'id_cus',
        'destination_point',
        'destination_time',
        'capacity',
        'date_start',
        'date_end',
        'pickup_point',
        'pickup_time',
        'fleet_type',
        'fleet_amount',
        'trip_nominal',
        'minimum_dp',
        'id_ms_payment',
        'payment_received',
        'payment_remaining',
    ];

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ms_payment_bookings():BelongsTo
    {
        return $this->belongsTo(MsPaymentBooking::class, 'id_ms_payment');
    }
}
