<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'price', 'quantity', 'prod_id', 'user_id', 'ordered', 'created_at','updated_at'];

    public function product(){
        return $this->belongsTo(Product::class, 'prod_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(){
        return $this->hasOne(Order::class,'id', 'cart_id');
    }

}
