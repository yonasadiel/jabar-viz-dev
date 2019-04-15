<?php

namespace Tests\Feature;

use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesControllerTest extends TestCase
{
    use RefreshDatabase;

    private $api = '/api/v1/series/';
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

    public function testGetSeries()
    {
        $response = $this->get($this->api);
        $response->assertStatus(200);

        $series = $response->json();
        $this->assertCount(3, $series, 'Series should be 3');

        $series_check = [
            'Populasi' => false,
            'PPK' => false,
            'Angka Harapan Hidup' => false,
        ];
        foreach ($series as $_series) {
            $series_check[$_series['name']] = true;
        }

        foreach ($series_check as $_series_check => $is_series_exist) {
            $this->assertTrue($is_series_exist, 'New series should be in response');
        }
    }

    public function testGetSeriesSuccess()
    {
        $series = Series::first();

        $response = $this->actingAs($this->pemprov_user)->json('GET', $this->api . $series->id . '/');
        $response->assertStatus(200);

        $retrieved_series = $response->json();
        $this->assertEquals($series['name'], $retrieved_series['name'], 'The series should have equal name to the retrieved name');
        $this->assertEquals($series['description'], $retrieved_series['description'], 'The series should have equal desc to the retrieved desc');
    }

    public function testGetSeriesFailedNotFound()
    {
        $response = $this->json('GET', $this->api . '1111/');
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_NOT_FOUND');
    }

    public function testAddSeriesSuccess()
    {
        $new_series = [
            'name' => 'Series 1',
            'description' => 'Deskripsi Series 1',
        ];

        $response = $this->actingAs($this->pemprov_user)->json('POST', $this->api, $new_series);
        $response->assertStatus(201);

        $series = $response->json();
        $this->assertEquals($series['name'], $new_series['name'], 'Series posted should have equal name to the posted name');
        $this->assertEquals($series['description'], $new_series['description'], 'Series posted should have equal desc to the posted desc');
    }

    public function testAddSeriesSuccessMissingDescription()
    {
        $new_series = [
            'name' => 'Series 1',
        ];

        $response = $this->actingAs($this->pemprov_user)->json('POST', $this->api, $new_series);
        $response->assertStatus(201);

        $series = $response->json();
        $this->assertEquals($series['name'], $new_series['name'], 'Series posted should have equal name to the posted name');
        $this->assertEquals($series['description'], '-', 'Series posted should "-" desc if not given desc');
    }

    public function testAddSeriesFailedMissingName()
    {
        $new_series = [
            'description' => 'Deskripsi Series 1',
        ];

        $response = $this->actingAs($this->pemprov_user)->json('POST', $this->api, $new_series);
        $response->assertStatus(400, 'Series should have name');

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_MISSING_NAME');
        $this->assertEquals(3, Series::count(), 'Series should not be added');
    }

    public function testUpdateSeriesSuccess()
    {
        $updated_series = Series::first();
        $new_series = [
            'name' => 'Series 1 baru',
            'description' => 'Deskripsi Series 1 baru',
        ];

        $response = $this->actingAs($this->pemprov_user)->json('PATCH', $this->api . $updated_series->id . '/', $new_series);
        $response->assertStatus(200);

        $series = $response->json();
        $this->assertEquals($series['name'], $new_series['name'], 'Series returned should have equal name to the patched name');
        $this->assertEquals($series['description'], $new_series['description'], 'Series returned should have equal desc to the patched desc');

        $updated_series->refresh();
        $this->assertEquals($updated_series['name'], $new_series['name'], 'The series should have equal name to the patched name');
        $this->assertEquals($updated_series['description'], $new_series['description'], 'The series should have equal desc to the patched desc');
    }

    public function testUpdateSeriesSuccessPartial()
    {
        $updated_series = Series::first();
        $old_desc = $updated_series->description;
        $new_series = [
            'name' => 'Series 1 baru',
        ];

        $response = $this->actingAs($this->pemprov_user)->json('PATCH', $this->api . $updated_series->id . '/', $new_series);
        $response->assertStatus(200);

        $series = $response->json();
        $this->assertEquals($series['name'], $new_series['name'], 'Series returned should have equal name to the patched name');
        $this->assertEquals($series['description'], $old_desc, 'Series returned should have equal desc to old desc');

        $updated_series->refresh();
        $this->assertEquals($updated_series['name'], $new_series['name'], 'The series should have equal name to the patched name');
        $this->assertEquals($updated_series['description'], $old_desc, 'The series should have equal desc to old desc');
    }

    public function testUpdateSeriesFailedNotFound()
    {
        $new_series = [
            'name' => 'Series 1 baru',
            'description' => 'Deskripsi Series 1 baru',
        ];
        $response = $this->actingAs($this->pemprov_user)->json('PATCH', $this->api . '1111/', $new_series);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_NOT_FOUND');
    }

    public function testDeleteSeriesSuccess()
    {
        $deleted_series = Series::first();

        $response = $this->actingAs($this->pemprov_user)->json('DELETE', $this->api . $deleted_series->id . '/');
        $response->assertStatus(200);

        $series = $response->json();
        $this->assertEquals($deleted_series['name'], $series['name'], 'The series should have equal name to the old name');
        $this->assertEquals($deleted_series['description'], $series['description'], 'The series should have equal desc to old desc');

        $this->assertEquals(2, Series::count(), 'Series should be deleted');
    }

    public function testDeleteSeriesFailedNotFound()
    {
        $response = $this->actingAs($this->pemprov_user)->json('DELETE', $this->api . '1111/');
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'SERIES_NOT_FOUND');
    }
}
