<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'id_bus',
    ];

    protected $guarded = ['id'];

    // public function bus()
    // {
    //     return $this->belongsTo(Bus::class, 'id_bus');
    // }

    public function images():BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
