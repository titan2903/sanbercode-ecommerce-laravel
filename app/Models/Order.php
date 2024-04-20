<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders'; // specify the table name
    protected $fillable = ["product_id", "user_id", "quantity", "order_date", "total_amount"];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
