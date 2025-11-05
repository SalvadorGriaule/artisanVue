<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
     protected $fillable = [
        'name',
        'descritpion',
        'price',
        "image",
        "seller_id"
    ];
    
    protected $appends = ['image_path'];

    protected function imagePath() : Attribute {
        return new Attribute(
            get: fn() => asset("/storage/".$this->image),
        );
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
