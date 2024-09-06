<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    ];

    protected $guarded = ['id'];
}
