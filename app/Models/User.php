<?php

namespace App\Models;

use Velocix\Database\Model;
use Velocix\Auth\Hash;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Auto-hash password
    public static function create($attributes)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return parent::create($attributes);
    }
}
