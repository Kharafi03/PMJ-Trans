<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outcome extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'outcomes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_m_outcome',
        'id_m_method_payment',
        'description',
        'nominal',
        'datetime',
        'image_receipt',
    ];

    protected $guarded = ['id'];
}
