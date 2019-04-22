<?php

namespace Tests\Feature;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    use RefreshDatabase;

    private $base_api = '/api/v1/';

    public function testGetCitiesSuccess()
    {
        $api = $this->base_api . 'cities';
        $response = $this->get($api);
        $response->assertStatus(200);

        $cities_count = City::count();

        $cities = $response->json();
        $this->assertCount($cities_count, $cities);
    }
}
