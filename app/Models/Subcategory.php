<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ["id","subcategory_name", "category_id", "created_at","updated_at"];


    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
