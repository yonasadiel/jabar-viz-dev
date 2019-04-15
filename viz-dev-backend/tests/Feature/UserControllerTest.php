<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private $api = '/api/v1/users/';
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

    public function testAddUserSuccess()
    {
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
            'role' => User::ROLE_ADMIN,
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(201);

        $user_json = $response->json();
        $this->assertEquals($user_json['username'], $new_user['username']);
        $this->assertEquals($user_json['email'], $new_user['email']);
        $this->assertEquals($user_json['role'], User::ROLE_ADMIN);
        $this->assertTrue(Auth::attempt([
            'username' => $new_user['username'],
            'password' => $new_user['password'],
        ]));
    }

    public function testAddUserSuccessMissingRole()
    {
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(201);

        $user = $response->json();
        $this->assertEquals($user['username'], $new_user['username']);
        $this->assertEquals($user['email'], $new_user['email']);
        $this->assertEquals($user['role'], User::ROLE_DINAS);
    }

    public function testAddUserFailedUsernameAlreadyTaken()
    {
        $new_user = [
            'username' => 'admin',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USERNAME_ALREADY_TAKEN');
    }

    public function testAddUserFailedMissingUsername()
    {
        $new_user = [
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USER_MISSING_USERNAME');
    }

    public function testAddUserFailedMissingPassword()
    {
        $new_user = [
            'username' => 'usertest',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USER_MISSING_PASSWORD');
    }

    public function testAddUserFailedMissingEmail()
    {
        $new_user = [
            'username' => 'admin',
            'password' => 'randompass',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USER_MISSING_EMAIL');
    }

    public function testAddUserAsPemprovUserFailed()
    {
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->pemprov_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(401);

        $err = $response->json();
        $this->assertEquals($err['code'], 'NOT_AUTHORIZED');
    }

    public function testAddUserAsDinasUserFailed()
    {
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->dinas_user)->json('POST', $this->api, $new_user);
        $response->assertStatus(401);

        $err = $response->json();
        $this->assertEquals($err['code'], 'NOT_AUTHORIZED');
    }
}
