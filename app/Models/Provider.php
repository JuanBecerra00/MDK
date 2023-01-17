<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['nit', 'name', 'phone', 'status', ];
    use HasFactory;
}
