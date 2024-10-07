<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'buses';

    protected $fillable = [
        'name',
        'license_plate',
        'production_year',
        'color',
        'machine_number',
        'chassis_number',
        'capacity',
        'baggage',
        'ms_buses_id',
    ];

    protected $guarded = ['id'];

    public function ms_buses():BelongsTo
    {
        return $this->belongsTo(MsBus::class);
    }

    public function bus():BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function images()
    {
        return $this->hasMany(BusImage::class, 'id_bus');
    }

    public function maintenances()
    {
        return $this->hasMany(BusMaintenance::class, 'id_bus');
    }

    public function buskir()
    {
        return $this->hasMany(BusKir::class, 'id_bus');
    }

    public function bustax()
    {
        return $this->hasMany(BusTax::class, 'id_bus');
    }

    public function tripbus()
    {
        return $this->hasMany(TripBus::class, 'id_bus');
    }

    public function bustaxlast()
    {
        return $this->hasMany(BusTax::class, 'id_bus')->orderBy('date', 'desc')->limit(1);
    }

    public function buskirlast()
    {
        return $this->hasMany(BusKir::class, 'id_bus')->orderBy('date_test', 'desc')->limit(1);
    }

}
