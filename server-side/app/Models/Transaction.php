<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Transaction extends Model{
    protected $fillable = ["quantity", "total_price", "user_id", "machine_id", "product_id"];
}
