<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'vizdev_entries';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function series()
    {
        return $this->belongsTo('\App\Models\Series', 'series_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('\App\Models\City', 'cities_id', 'id');
    }
}
