<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'prod_title', 'prod_description', 'prod_image', 'prod_quantity', 'prod_price', 'prod_discount', 'created_at', 'updated_at'];

    // public function category(){
    //     return $this->belongsTo(Category::class, 'category_id');
    // }

    public function subcategories(){
        return $this->belongsToMany(Subcategory::class);
    }
    
    public function carts(){
        return $this->hasMany(Cart::class, 'prod_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'prod_id');
    }

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('prod_title', 'LIKE', '%' . request('search') . '%');
        }
        if($filters['order-by'] ?? false){
            if(request('order-by')=='Latest') $query->orderBy('products.id', 'desc');
            if(request('order-by')=='Low to High') $query->orderByRaw('IFNULL(products.prod_discount, products.prod_price) ASC');
            if(request('order-by')=='High to Low') $query->orderByRaw('IFNULL(products.prod_discount, products.prod_price) DESC');
        }
    
        //vendos dhe subcategory
        if($filters['search-admin'] ?? false){
            $query->where('prod_title', 'LIKE', '%' . request('search-admin') . '%')
            ->orWhere('category_name', 'LIKE', '%'. request('search-admin') . '%');
        }
     }
   
}
