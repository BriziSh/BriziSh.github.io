<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{ 
    use HasFactory;
    use Notifiable;
    protected $fillable=['id', 'email', 'subject', 'numorder', 'description', 'created_at', 'updated_at'];
}
