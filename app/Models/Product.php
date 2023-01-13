<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['providers_id', 'bills_id', 'name', 'ammount', 'price', 'type', 'status', 'updated_at'];
    use HasFactory;
}
