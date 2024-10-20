<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'incomes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_booking',
        'id_m_income',
        'id_m_method_payment',
        'description',
        'nominal',
        'id_ms_income',
        'datetime',
        'image_receipt',
        // 'payment_received',
        // 'payment_remaining',
    ];

    protected $guarded = ['id'];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }

    public function m_income(): BelongsTo
    {
        return $this->belongsTo(MIncome::class, 'id_m_income');
    }

    public function m_method_payment(): BelongsTo
    {
        return $this->belongsTo(MMethodPayment::class, 'id_m_method_payment');
    }

    public function ms_income(): BelongsTo
    {
        return $this->belongsTo(MsIncome::class, 'id_ms_income');
    }
}
