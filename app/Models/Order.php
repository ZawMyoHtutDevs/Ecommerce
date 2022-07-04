<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'total',
        'user_id',
        'status',
        'payment_id',
        'address_id',
        'note'
    ];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function payment()
    {
        return $this->belongsTo(\App\Models\Payment::class, 'payment_id');
    }

    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'address_id');
    }
    public function order_items()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }
}
