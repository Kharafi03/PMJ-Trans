<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MsIncome extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'ms_incomes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    protected $guarded = ['id'];
}
