<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MsUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ms_users';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    protected $guarded = ['id'];

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'id_user');
    // }
}
