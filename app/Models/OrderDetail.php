<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details'; // specify the table name
    protected $fillable = ["order_id", "total_amount", "provider", "payment_date", "status"];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
