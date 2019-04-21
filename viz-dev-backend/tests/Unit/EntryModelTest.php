<?php

namespace Tests\Unit;

use App\Models\Entry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryModelTest extends TestCase
{
    use RefreshDatabase;

    public function testUpsertUpdate()
    {
        $entry = Entry::first();
        $entry_count = Entry::count();
        list($updated_entry, $created) = Entry::upsert([
            'series_id' => $entry->series_id,
            'cities_id' => $entry->cities_id,
            'year' => $entry->year,
            'value' => $entry->value + 20,
        ]);
        $this->assertFalse($created);
        $this->assertEquals($updated_entry->series_id, $entry->series_id);
        $this->assertEquals($updated_entry->cities_id, $entry->cities_id);
        $this->assertEquals($updated_entry->year, $entry->year);
        $this->assertEquals($updated_entry->value, $entry->value + 20);

        $entry->refresh();
        $this->assertEquals($updated_entry->value, $entry->value);

        $this->assertEquals($entry_count, Entry::count());
    }

    public function testUpsertInsert()
    {
        $entry = Entry::first();
        $entry_count = Entry::count();
        list($updated_entry, $created) = Entry::upsert([
            'series_id' => $entry->series_id,
            'cities_id' => $entry->cities_id,
            'year' => $entry->year + 100,
            'value' => $entry->value + 20,
        ]);
        $this->assertTrue($created);
        $this->assertEquals($updated_entry->series_id, $entry->series_id);
        $this->assertEquals($updated_entry->cities_id, $entry->cities_id);
        $this->assertEquals($updated_entry->year, $entry->year + 100);
        $this->assertEquals($updated_entry->value, $entry->value + 20);

        $this->assertEquals($entry_count + 1, Entry::count());
    }
}
