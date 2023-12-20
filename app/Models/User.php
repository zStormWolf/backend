<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'cedula',
        'username',
        'country',
        'city',
        'address',
        'office',
        'tel',
        'dateofbirth',
        'status',
        'role_id',
        'tariff_id',
        // 'role',
        // 'tariff',
        'hash',
        'salt',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relación con el modelo Tariff
    public function tariff()
    {
        return $this->belongsTo(Tariff::class, 'tariff_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dateofbirth' => 'date', // Asegura que dateofbirth se maneje como una instancia de fecha
    ];
}
