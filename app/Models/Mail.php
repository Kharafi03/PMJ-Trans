<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mail extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'mails';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'template_chat'
    ];

    protected $guarded = ['id'];
}
