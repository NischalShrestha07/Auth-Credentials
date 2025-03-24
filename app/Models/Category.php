<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'status', 'note'];
    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
