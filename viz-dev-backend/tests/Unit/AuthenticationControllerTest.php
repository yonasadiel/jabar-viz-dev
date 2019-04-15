<?php

namespace Tests\Unit;

use App\Models\Entry;
use App\Models\Series;
use App\Models\User;
use App\Http\Controllers\SeriesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationControllerTest extends TestCase
{
    use RefreshDatabase;

    private $base_api = '/api/v1/';
    private $admin_user = null;
    private $pemprov_user = null;
    private $dinas_user = null;

    public function setUp() : void
    {
        parent::setUp();
        $this->admin_user = User::where('role', User::ROLE_ADMIN)->first();
        $this->pemprov_user = User::where('role', User::ROLE_PEMPROV)->first();
        $this->dinas_user = User::where('role', User::ROLE_DINAS)->first();
    }

    public function testLoginAsAdminSuccess()
    {
        $api = $this->base_api . 'login';
        $login_credential = [
            'username' => 'admin',
            'password' => 'vizdevadmin4992',
        ];

        $response = $this->json('POST', $api, $login_credential);
        $response->assertStatus(200);

        $user = $response->json();
        $this->assertEquals($user['username'], $login_credential['username']);
        $this->assertEquals($user['role'], User::ROLE_ADMIN);
    }

    public function testLoginAsPemprovSuccess()
    {
        $api = $this->base_api . 'login';
        $login_credential = [
            'username' => 'sipd',
            'password' => 'vizdevsipd8162',
        ];

        $response = $this->json('POST', $api, $login_credential);
        $response->assertStatus(200);

        $user = $response->json();
        $this->assertEquals($user['username'], $login_credential['username']);
        $this->assertEquals($user['role'], User::ROLE_PEMPROV);
    }

    public function testLoginAsDinasSuccess()
    {
        $api = $this->base_api . 'login';
        $login_credential = [
            'username' => 'dinas',
            'password' => 'vizdevdinas6172',
        ];

        $response = $this->json('POST', $api, $login_credential);
        $response->assertStatus(200);

        $user = $response->json();
        $this->assertEquals($user['username'], $login_credential['username']);
        $this->assertEquals($user['role'], User::ROLE_DINAS);
    }

    public function testLoginFailed()
    {
        $api = $this->base_api . 'login';
        $login_credential = [
            'username' => 'admin',
            'password' => 'random string',
        ];

        $response = $this->json('POST', $api, $login_credential);
        $response->assertStatus(400);
    }

    public function testMeAsAdmin()
    {
        $api = $this->base_api . 'me';
        $response = $this->actingAs($this->admin_user)->json('GET', $api, []);
        $response->assertStatus(200);

        $user = $response->json();
        $this->assertEquals($user['username'], $this->admin_user->username);
        $this->assertEquals($user['role'], $this->admin_user->role);
    }

    public function testMeAsPemprov()
    {
        $api = $this->base_api . 'me';
        $response = $this->actingAs($this->pemprov_user)->json('GET', $api, []);
        $response->assertStatus(200);

        $user = $response->json();
        $this->assertEquals($user['username'], $this->pemprov_user->username);
        $this->assertEquals($user['role'], $this->pemprov_user->role);
    }

    public function testMeAsDinas()
    {
        $api = $this->base_api . 'me';
        $response = $this->actingAs($this->dinas_user)->json('GET', $api, []);
        $response->assertStatus(200);

        $user = $response->json();
        $this->assertEquals($user['username'], $this->dinas_user->username);
        $this->assertEquals($user['role'], $this->dinas_user->role);
    }

    public function testMeNotAuthenticated()
    {
        $api = $this->base_api . 'me';
        $response = $this->json('GET', $api, []);
        $response->assertStatus(401);
    }
}
