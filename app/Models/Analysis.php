<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Analysis extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'analyses';

    protected $fillable = [
        'month',
        'total_bus',
        'total_driver',
        'total_income',
        'total_spending',
        'total_profit',
        'total_customer',
        'total_trip_finish',
    ];

    protected $guarded = ['id'];
}
