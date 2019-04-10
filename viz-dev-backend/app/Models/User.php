<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    const ROLE_ADMIN = 'admin';
    const ROLE_DINAS = 'dinas';
    const ROLE_PEMPROV = 'pemprov';

    use Notifiable;

    protected $fillable = ['username', 'email', 'password'];
    protected $hidden = ['password', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function can_modify_users() {
        return $this->role === self::ROLE_ADMIN;
    }

    public function can_modify_entries() {
        return $this->role === self::ROLE_DINAS || $this->role === self::ROLE_PEMPROV;
    }
}
