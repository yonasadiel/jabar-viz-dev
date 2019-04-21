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

    public static function upsert($raw_entry)
    {
        $entry = self::where([
            ['series_id', '=', $raw_entry['series_id']],
            ['cities_id', '=', $raw_entry['cities_id']],
            ['year', '=', $raw_entry['year']],
        ])->first();
        $created = true;

        if ($entry) {
            $entry->value = $raw_entry['value'];
            $entry->save();

            $created = false;
        } else {
            $entry = new Entry();
            $entry->series_id = $raw_entry['series_id'];
            $entry->cities_id = $raw_entry['cities_id'];
            $entry->year = $raw_entry['year'];
            $entry->value = $raw_entry['value'];
            $entry->save();
        }

        return [$entry, $created];
    }
}
