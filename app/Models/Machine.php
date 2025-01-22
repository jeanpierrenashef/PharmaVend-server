<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Machine extends Model{
    use HasFactory;
    protected $fillable = ["location", "latitude", "longitude", "status"];
}
