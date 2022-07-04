<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_name',
        'order_id',
        'quantity',
        'discount_type',
        'price',
    ];
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }
}
