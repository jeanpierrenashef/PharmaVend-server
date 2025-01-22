<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ["machine_id", "product_id", "quantity"];
    public $timestamps = false;
}
