<?php

namespace Tests\Feature;

use App\Models\Entry;
use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryControllerTest extends TestCase
{
    use RefreshDatabase;

    private $base_api = '/api/v1/';
    private $admin_user = null;
    private $pemprov_user = null;
    private $dinas_user = null;

    public function setUp() : void
    {
        parent::setUp();
        $this->admin_user = User::where('role', 'admin')->first();
        $this->pemprov_user = User::where('role', 'pemprov')->first();
        $this->dinas_user = User::where('role', 'dinas')->first();
    }

    public function testGetEntriesSuccess()
    {
        $api = $this->base_api . 'series/1/entries';
        $response = $this->get($api);
        $response->assertStatus(200);

        $entries_count = Entry::where('series_id', 1)->count();

        $entries = $response->json();
        $this->assertCount($entries_count, $entries, 'Entries not have same count');
    }

    public function testGetEntriesFailedSeriesNotFound()
    {
        $api = $this->base_api . 'series/1111/entries';
        $response = $this->get($api);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_NOT_FOUND');
    }

    public function testGetEntrySuccess()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/' . $entry->cities_id . '/year/' . $entry->year . '/entry';
        $response = $this->get($api);
        $response->assertStatus(200);

        $retrieved_entry = $response->json();
        $this->assertEquals($entry->value, $retrieved_entry['value'], 'Entry value retireved and actual should be the same');
    }

    public function testGetEntryFailedSeriesNotFound()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();

        $api = $this->base_api . 'series/1111/city/' . $entry->cities_id . '/year/' . $entry->year . '/entry';
        $response = $this->get($api);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_NOT_FOUND');
    }

    public function testGetEntryFailedCityNotFound()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/1111/year/' . $entry->year . '/entry';
        $response = $this->get($api);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'CITY_NOT_FOUND');
    }

    public function testGetEntryFailedEntryNotFound()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/' . $entry->cities_id . '/year/3000/entry';
        $response = $this->get($api);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'ENTRY_NOT_FOUND');
    }

    public function testAddEntrySuccess()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'value' => 21827,
        ];

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/' . $entry->cities_id . '/year/2020/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(201);

        $returned_entry = $response->json();
        $this->assertEquals($returned_entry['series_id'], $entry->series_id);
        $this->assertEquals($returned_entry['cities_id'], $entry->cities_id);
        $this->assertEquals($returned_entry['year'], 2020);
        $this->assertEquals($returned_entry['value'], $new_entry['value']);

        $db_entry = Entry::find($returned_entry['id']);
        $this->assertEquals($db_entry->series_id, $entry->series_id);
        $this->assertEquals($db_entry->cities_id, $entry->cities_id);
        $this->assertEquals($db_entry->year, 2020);
        $this->assertEquals($db_entry->value, $new_entry['value']);
    }

    public function testAddEntryFailedSeriesNotFound()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'value' => 21827,
        ];

        $api = $this->base_api . 'series/12345/city/' . $entry->cities_id . '/year/2020/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_NOT_FOUND');
    }

    public function testAddEntryFailedCityNotFound()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'value' => 21827,
        ];

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/121212/year/2020/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'CITY_NOT_FOUND');
    }

    public function testAddEntryFailedMissingValue()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'other_value' => 21827,
        ];

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/' . $entry->cities_id . '/year/2020/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'ENTRY_MISSING_VALUE');
    }

    public function testUpdateEntrySuccess()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'value' => 21827,
        ];

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/' . $entry->cities_id . '/year/' . $entry->year . '/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(200);

        $returned_entry = $response->json();
        $this->assertEquals($returned_entry['series_id'], $entry->series_id);
        $this->assertEquals($returned_entry['cities_id'], $entry->cities_id);
        $this->assertEquals($returned_entry['year'], $entry->year);
        $this->assertEquals($returned_entry['value'], $new_entry['value']);

        $db_entry = Entry::find($returned_entry['id']);
        $this->assertEquals($db_entry->series_id, $entry->series_id);
        $this->assertEquals($db_entry->cities_id, $entry->cities_id);
        $this->assertEquals($db_entry->year, $entry->year);
        $this->assertEquals($db_entry->value, $new_entry['value']);
    }

    public function testUpdateEntryFailedSeriesNotFound()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'value' => 21827,
        ];

        $api = $this->base_api . 'series/12345/city/' . $entry->cities_id . '/year/' . $entry->year . '/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_NOT_FOUND');
    }

    public function testUpdateEntryFailedCityNotFound()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'value' => 21827,
        ];

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/121212/year/' . $entry->year . '/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'CITY_NOT_FOUND');
    }

    public function testUpdateEntryFailedMissingValue()
    {
        $entry = Entry::orderBy('id', 'desc')->take(1)->first();
        $new_entry = [
            'other_value' => 21827,
        ];

        $api = $this->base_api . 'series/' . $entry->series_id . '/city/' . $entry->cities_id . '/year/' . $entry->year . '/entry';
        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_entry);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'ENTRY_MISSING_VALUE');
    }
}
