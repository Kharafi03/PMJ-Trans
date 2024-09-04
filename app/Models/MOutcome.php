<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MOutcome extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'm_outcomes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    protected $guarded = ['id'];
}
