<?php

namespace App\Http\Controllers\Importer;

use App\Models\City;
use App\Models\Entry;
use App\Models\Series;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CityNotFoundException extends Exception {
    //
}

class EntriesImporter implements ToCollection, WithHeadingRow
{
    protected $series;

    public function __construct(Series $series = null) {
        $this->series = $series;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $city = City::where('name', $row['kab_kota'])->first();
            if ($city === null ) {
                throw new CityNotFoundException('city ' . $row['kab_kota'] . ' not found.');
            }
            $series = $this->series;

            if ($series === null) {
                $series = Series::where('name', $row['series'])->first();

                if ($series === null) {
                    $series = new Series();
                    $series->name = $row['series'];
                    $series->description = '';
                    $series->save();
                }
            }

            $entry = new Entry();
            Entry::upsert([
                'cities_id' => $city->id,
                'series_id' => $series->id,
                'year' => $row['tahun'],
                'value' => $row['nilai'],
            ]);
        }
    }
}
