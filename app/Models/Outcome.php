<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outcome extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'outcomes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_m_outcome',
        'outcome_code',
        'id_m_method_payment',
        'description',
        'nominal',
        'datetime',
        'image_receipt',
        'check',
    ];

    protected $guarded = ['id'];

    public function m_outcome(): BelongsTo
    {
        return $this->belongsTo(MOutcome::class, 'id_m_outcome');
    }

    public function m_method_payment(): BelongsTo
    {
        return $this->belongsTo(MMethodPayment::class, 'id_m_method_payment');
    }

    // public function booking(): BelongsTo
    // {
    //     return $this->belongsTo(Booking::class, 'id_booking');
    // }
}
