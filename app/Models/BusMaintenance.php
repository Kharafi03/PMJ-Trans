<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusMaintenance extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'bus_maintenances';

    // protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_bus',
        'id_user',
        'id_m_maintenance',
        'description',
        'image',
        'date',
        'location',
        'cost',
        'image_receipt',
        'latitude',
        'longitude',
    ];

    public function buses():BelongsTo
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function m_maintenances():BelongsTo
    {
        return $this->belongsTo(MMaintenance::class, 'id_m_maintenance');
    }
}
