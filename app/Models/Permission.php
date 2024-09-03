<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Permission extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'permissions';

    protected $dates = ['deleted_at'];

    protected $fillable = ['role'];

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'id_user');
    // }
}
