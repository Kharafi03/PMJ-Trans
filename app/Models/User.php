<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable // implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles, HasPanelShield, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'number_phone',
        'address',
        'password',
        'nik',
        'sim',
        'id_ms',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function busMaintenances()
    {
        return $this->hasMany(BusMaintenance::class, 'id_user');
    }

    public function msUsers(): BelongsTo
    {
        return $this->belongsTo(MsUser::class, 'id_ms');
    }

    // public function permissions(): BelongsTo
    // {
    //     return $this->belongsTo(Permission::class, 'id_role');
    // }
}
