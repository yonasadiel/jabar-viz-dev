<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table = 'vizdev_series';
    protected $fillable = ['name', 'description'];
    protected $hidden = ['created_at', 'updated_at'];

    public function entries()
    {
        return $this->hasMany('\App\Models\Entry', 'series_id', 'id');
    }
}
