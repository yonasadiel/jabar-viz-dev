<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BasicHttpTest extends TestCase
{
    use RefreshDatabase;

    private $api = '/api/v1/entries';

    public function setUp() : void
    {
        parent::setUp();
    }

    public function testCorsHTTP()
    {
        $response = $this->withHeaders([
            'Origin' => 'http://localhost',
        ])->json('GET', $this->api);
        $response->assertStatus(200);

        $this->assertEquals('http://localhost', $response->headers->get('Access-Control-Allow-Origin'));
        $this->assertEquals('true', $response->headers->get('Access-Control-Allow-Credentials'));
    }

    public function testCorsHTTPS()
    {
        $response = $this->withHeaders([
            'Origin' => 'https://localhost',
        ])->json('GET', $this->api);
        $response->assertStatus(200);

        $this->assertEquals('https://localhost', $response->headers->get('Access-Control-Allow-Origin'));
        $this->assertEquals('true', $response->headers->get('Access-Control-Allow-Credentials'));
    }
}
