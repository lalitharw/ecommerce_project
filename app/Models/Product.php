<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function brand()
    {
        return $this->belongsTo(Brand::class, "brand_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function carts()
    {
        return $this->belongsToMany(User::class, "carts", "user_id", "product_id");
    }

    public function wishlists()
    {
        return $this->belongsToMany(User::class, "wishlists", "product_id", "user_id");
    }


}
