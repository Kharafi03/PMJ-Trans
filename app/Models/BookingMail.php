<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingMail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'booking_mails';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_booking',
        'message',
    ];

    protected $guarded = ['id'];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }
}
