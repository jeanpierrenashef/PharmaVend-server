<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Inventory extends Model{
    public $incrementing = false;
    
    protected $fillable = ["machine_id", "product_id", "quantity"];
}
