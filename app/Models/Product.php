<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'permalink',
        'asset',
        'description',
        'detail',
        'category_id',
        'inventory_id',
        'discount_id',
        'price',
        'user_id',
        'status',
    ];
    public function inventory()
    {
        return $this->belongsTo(\App\Models\Inventory::class, 'inventory_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    
    public function discount()
    {
        return $this->belongsTo(\App\Models\Discount::class, 'discount_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
