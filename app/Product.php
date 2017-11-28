<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'image_url'
    ];

    public function getImageAttribute()
    {
        $imagePath = $this->image_url ? 'storage/' . $this->image_url : 'images/pi2.jpg';
        return asset( $imagePath);
    }

    public function getFinalPriceAttribute()
    {
        return $this->price . ' РУБ';
    }
}
