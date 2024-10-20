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
        'booking_code',
        'id_cus',
        'destination_point',
        //'destination_time',
        'capacity',
        'date_start',
        'date_end',
        'pickup_point',
        //'pickup_time',
        'fleet_amount',
        'legrest',
        'description',
        'trip_nominal',
        'minimum_dp',
        'id_ms_payment',
        'id_ms_booking',
        'payment_received',
        'payment_remaining',
        'total_spend',
        'profit',
    ];

    // Casting untuk kolom tanggal
    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'destination_time' => 'datetime:H:i',
        'pickup_time' => 'datetime:H:i',
    ];



    // Relasi ke Customer (User)
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_cus');
    }

    // Relasi ke MsPayment
    public function ms_payment(): BelongsTo
    {
        return $this->belongsTo(MsPaymentBooking::class, 'id_ms_payment');
    }

    public function ms_booking(): BelongsTo
    {
        return $this->belongsTo(MsBooking::class, 'id_ms_booking');
    }

    // Relasi ke Review
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'id_booking');
    }

    public function tripbus()
    {
        return $this->hasMany(TripBus::class, 'id_booking');
    }

    public function tripbuss()
    {
        return $this->hasMany(TripBus::class, 'id_booking', 'id_bus', 'id_driver', 'id_codriver');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class, 'id_booking');
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class, 'id_booking');
    }

    public function ms_income(): BelongsTo
    {
        return $this->belongsTo(MsIncome::class, 'id_ms_income');
    }

    public function m_method_payment(): BelongsTo
    {
        return $this->belongsTo(MMethodPayment::class, 'id_ms_income');
    }

    public function tripbusspend()
    {
        return $this->hasMany(TripBusSpend::class, 'id_trip_bus');
    }

    public function destination()
    {
        return $this->hasMany(Destination::class, 'id_booking');
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(BookingMail::class, 'id_booking');
    }
}
