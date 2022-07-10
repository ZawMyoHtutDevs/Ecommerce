<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'discount_price',
        'discount_percent',
        'gif_products_id',
        'status'
    ];
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'discount_id');
    }
}
