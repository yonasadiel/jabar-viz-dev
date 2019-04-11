<?php

namespace Tests\Unit;

use App\Models\Series;
use App\Http\Controllers\SeriesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesControllerTest extends TestCase
{
    use RefreshDatabase;

    private $api = '/api/v1/series/';

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
            $this->assertTrue($is_series_exist, 'Series ' . $_series_check . ' should be in response');
        }
    }

    public function testAddSeries()
    {
        $new_series = [
            'name' => 'Series 1',
            'description' => 'Deskripsi Series 1',
        ];
        $response = $this->json('POST', $this->api, $new_series);

        $response->assertStatus(201);

        $series = $response->json();
        $this->assertEquals($series['name'], $new_series['name'], 'Series posted should have equal name to the posted name');
        $this->assertEquals($series['description'], $new_series['description'], 'Series posted should have equal desc to the posted desc');
    }
}
