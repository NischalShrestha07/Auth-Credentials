<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'item_name',
        'slug',
        'item_model',
        'item_code',
        'sub_category',
        'brand',
        'unit',
        'tax',
        'tax_type',
        'regular_price',
        'discount',
        'selling_price',
        'status',
        'image',
        'note',
        'voice_tags',
        'sub_cat_id',
        'image_path',
    ];
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_cat_id');
    }
}
