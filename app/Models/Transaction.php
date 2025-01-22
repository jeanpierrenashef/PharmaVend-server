<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model{
    use HasFactory;
    protected $fillable = ["quantity", "total_price", "user_id", "machine_id", "product_id", "dispensed"];
}
