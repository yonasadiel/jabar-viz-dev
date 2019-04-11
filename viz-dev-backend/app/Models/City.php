<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'vizdev_cities';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
