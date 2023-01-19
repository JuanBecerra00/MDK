<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['customer_id', 'bills_id', 'name', 'ammount', 'price', 'type', 'status', 'updated_at'];
    use HasFactory;
}
