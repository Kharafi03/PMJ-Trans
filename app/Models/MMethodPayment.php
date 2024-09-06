<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MMethodPayment extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'm_method_payments';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    protected $guarded = ['id'];
}
