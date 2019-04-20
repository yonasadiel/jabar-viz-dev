<?php

namespace Tests\Unit;

use App\Http\Controllers\Importer\EntriesImporter;
use App\Http\Controllers\Importer\CityNotFoundException;
use App\Models\City;
use App\Models\Entry;
use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class EntriesImporterTest extends TestCase
{
    use RefreshDatabase;

    public function testKnownSeriesInsert()
    {
        $series = Series::first();
        $city = City::first();
        $entry_count = Entry::count();

        $importer = new EntriesImporter($series);
        $importer->collection(new Collection([
            [
                'kab_kota' => $city->name,
                'tahun' => '1024',
                'nilai' => '212.23',
            ]
        ]));

        $entry = Entry::where([
            ['series_id', $series->id],
            ['cities_id', $city->id],
            ['year', 1024]
        ])->first();
        $this->assertEquals(212.23, $entry->value);
        $this->assertEquals($entry_count + 1, Entry::count());
    }

    public function testKnownSeriesUpdate()
    {
        $entry = Entry::first();
        $entry_count = Entry::count();

        $importer = new EntriesImporter($entry->series);
        $importer->collection(new Collection([
            [
                'kab_kota' => $entry->city->name,
                'tahun' => $entry->year,
                'nilai' => '212.23',
            ]
        ]));

        $updated_entry = Entry::where([
            ['series_id', $entry->series->id],
            ['cities_id', $entry->city->id],
            ['year', $entry->year]
        ])->first();
        $this->assertEquals(212.23, $updated_entry->value);
        $this->assertEquals($entry_count, Entry::count());
    }

    public function testKnownSeriesFailedCityNotFound()
    {
        $entry = Entry::first();
        $entry_count = Entry::count();

        $importer = new EntriesImporter($entry->series);
        $this->expectException(CityNotFoundException::class);
        $importer->collection(new Collection([
            [
                'kab_kota' => 'Random city name',
                'tahun' => $entry->year,
                'nilai' => '212.23',
            ]
        ]));
    }
}
