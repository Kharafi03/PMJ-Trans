<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'settings';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'logo',
        'address',
        'email',
        'contact',
        'open_hours',
        'description',
        'maps',
        'sosmed_ig',
        'sosmed_fb',
        'sosmed_yt',
        'footer',
        'about_us',
    ];

    protected $guarded = ['id'];
}
