<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[ 
    "name_en",
    "name_ar",
    "price",
    "quantity",
    "status",
    "details_ar",
    "details_en",
    "brand_id",
    "subcategory_id",
    "code",
    "image"

    ];
    public function getImageAttribute($image)
    {
        return url('/images/products/'.$image);
    }
}

