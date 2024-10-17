<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Use this if extending User
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable // Make sure to extend Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Add any other methods or properties as needed
}
