<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function trip()
    {
        return $this->hasMany(TripBus::class);
    }

}
