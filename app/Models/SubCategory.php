<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['name','status','slug','cat_id','code','note'];
    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
