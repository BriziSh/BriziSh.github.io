<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    use HasFactory;
    protected $table = 'product_subcategory';
    protected $fillable = ["id", "subcategory_id", "product_id","created_at","updated_at"];
}
