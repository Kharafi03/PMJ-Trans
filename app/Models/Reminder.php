<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'reminders';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'description',
        'check',
    ];

    protected $guarded = ['id'];
}