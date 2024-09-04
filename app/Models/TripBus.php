<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripBus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trip_buses';

    // protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_booking',
        'id_bus',
        'id_customer',
        'id_driver',
        'id_codriver',
        'balanced',
        'km_start',
        'km_end',
        'total_spend',
        'total_spend_bbm',
    ];
}
