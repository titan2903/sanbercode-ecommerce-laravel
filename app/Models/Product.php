<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; // specify the table name
    protected $fillable = ["name", "description", "price", "quantity", "image_url", "category_id"];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function carts()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
