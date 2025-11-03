<?php

namespace App\Models;

use App\Models\User;

class Seller extends User
{
    protected $fillable = [
        "siret"
    ];
    
    protected $attributes = [
        'role' => "seller"
    ];

    protected $table = "users";
}
