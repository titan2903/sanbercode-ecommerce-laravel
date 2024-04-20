<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category'; // specify the table name
    protected $fillable = ["name", "description"];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
