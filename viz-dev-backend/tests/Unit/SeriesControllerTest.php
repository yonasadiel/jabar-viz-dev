<?php

namespace Tests\Unit;

use App\Models\Series;
use App\Http\Controllers\SeriesController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesControllerTest extends TestCase
{
    public function testGetSeries()
    {
        $response = $this->get('/api/v1/series/');
        $response->assertStatus(200);

        $series = $response->json();
        $this->assertTrue(count($series) == 3, 'Series should be 3');

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
}
