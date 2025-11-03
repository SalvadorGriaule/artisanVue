<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends User
{
    protected $fillable = [
        "siret"
    ];

    protected $attributes = [
        'role' => "seller"
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected $table = "users";
}
