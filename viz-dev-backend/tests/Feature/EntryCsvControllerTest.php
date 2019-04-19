<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryCsvControllerTest extends TestCase
{
    use RefreshDatabase;

    private $api = '/api/v1/entries';

    public function setUp() : void
    {
        parent::setUp();
    }

    public function testContentType()
    {
        $response = $this->get($this->api);
        $response->assertStatus(200);

        $this->assertContains('text/csv', $response->headers->get('Content-Type'));
    }

    public function testHeader()
    {
        $response = $this->get($this->api);
        $response->assertStatus(200);

        $response->assertSeeText('regency;indicator;2010;2011;2012;2013;2014;2015;2016');
    }

    public function testCities()
    {
        $response = $this->get($this->api);
        $response->assertStatus(200);

        $cities = City::all();

        foreach ($cities as $city) {
            $response->assertSeeText($city->name);
        }
    }

    public function testSeries()
    {
        $response = $this->get($this->api);
        $response->assertStatus(200);

        $series = Series::all();

        foreach ($series as $_series) {
            $response->assertSeeText($_series->name);
        }
    }
}
