<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusKir extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bus_kirs';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'kir_code',
        'id_bus',
        'id_user',
        'description',
        'date_test',
        'expiration',
        'nominal',
        'image',
        'id_m_method_payment',
    ];

    public function buses():BelongsTo
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function m_method_payment(): BelongsTo
    {
        return $this->belongsTo(MMethodPayment::class, 'id_m_method_payment');
    }
}