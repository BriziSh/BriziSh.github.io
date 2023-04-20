<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["id","category_name","created_at","updated_at"];

    // public function products(){
    //     return $this->hasMany(Product::class, 'category_id');
    // }

    public function subcategories(){
        return $this->hasMany(Subcategory::class, 'category_id');
    }
    
}
 