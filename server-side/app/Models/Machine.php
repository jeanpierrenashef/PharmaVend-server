<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Machine extends Model{
    protected $fillable = ["location", "lattitude", "longitude", "status"];
}
