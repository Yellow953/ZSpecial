<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function secondary_images()
    {
        return $this->hasMany(SecondaryImage::class);
    }

    public function getProfit()
    {
        return round((($this->sell_price - $this->buy_price) * 100 / $this->buy_price), 2);
    }

}