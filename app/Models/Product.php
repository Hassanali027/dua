<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'image_path',
        'status',
        'is_on_sale',
        'sale_price',
        'color',
        'size',
        'quantity',
        'product_detail',
        'season',
        'product_details',
        'product_care',
        'shipping',
        'return_exchange',
        'is_featured',
        'is_best_selling',
        'is_most_in_demand',
        'is_new_arrival',
        'is_bridal_party_wear',
        'show_in_navbar',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id');
    }
}
