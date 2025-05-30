<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'image', 'status', 'price'];

    public function category()
{
    return $this->belongsTo(Category::class);
}
public function products()
    {
        return $this->hasMany(Product::class);
    }
}
