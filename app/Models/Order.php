<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [ 'cart_id', 'address', 'payment_status', 'delivery_status', 'created_at', 'updated_at'];

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('name', 'LIKE', '%'.request('search').'%')
            // ->orWhere('phone', 'LIKE', '%'.request('search').'%')
            ->orWhere('prod_title', 'LIKE', '%'.request('search').'%')
            ->orWhere('orders.id', '=', request('search'));
        }

        if($filters['search-user'] ?? false){
            $query->where('prod_title', 'LIKE', '%'.request('search-user').'%')
            ->orWhere('orders.id', '=', request('search-user'));
        }
    }
}
