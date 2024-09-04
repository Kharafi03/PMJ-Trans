<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripFinished extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'trip_finisheds';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_booking',
        'trip_value',
        'total_spend',
        'profit',
        'id_ms_trip_finished',
    ];

    public function mstripfinished():BelongsTo
    {
        return $this->belongsTo(MsTripFinished::class);
    }
}
