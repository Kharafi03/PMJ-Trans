<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsAndConditions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'terms_and_conditions';

    protected $fillable = [
        'heading',
        'description',
    ];
}
