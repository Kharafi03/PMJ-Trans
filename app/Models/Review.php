<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'reviews';

    protected $fillable = [
        'id_booking',
        'feedback',
        'rating',
    ];


    protected $guarded = ['id'];
    // Relasi ke Booking
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }
}
