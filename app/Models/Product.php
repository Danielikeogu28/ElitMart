<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = ['name', 'price', 'color', 'about', 'sku', 'tag', 'description', 'image'];
   
   public function colors()
   {
       return $this->hasMany(ProductColor::class);
   }

   public function images()
   {
       return $this->hasMany(ProductImage::class);
   }
}
