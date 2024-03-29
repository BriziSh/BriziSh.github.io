<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscribe extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['id', 'email', 'created_at', 'updated_at'];
}
