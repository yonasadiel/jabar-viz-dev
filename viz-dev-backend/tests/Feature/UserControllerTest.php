<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private $base_api = '/api/v1/users/';
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

    public function testGetUsers()
    {
        $api = $this->base_api;
        $response = $this->actingAs($this->admin_user)->json('GET', $api);
        $response->assertStatus(200);
        $response->assertJsonCount(User::count());

        $users = $response->json();
        foreach ($users as $user) {
            $this->assertArrayHasKey('id', $user);
            $this->assertArrayHasKey('username', $user);
            $this->assertArrayHasKey('email', $user);
            $this->assertArrayHasKey('role', $user);
            $this->assertArrayNotHasKey('password', $user);
            $this->assertArrayNotHasKey('created_at', $user);
            $this->assertArrayNotHasKey('updated_at', $user);
        }
    }

    public function testGetFailedNotAuthorized()
    {
        $api = $this->base_api;
        $response = $this->actingAs($this->pemprov_user)->json('GET', $api);
        $response->assertStatus(401);

        $err = $response->json();
        $this->assertEquals($err['code'], 'NOT_AUTHORIZED');
    }

    public function testAddUserSuccess()
    {
        $api = $this->base_api;
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
            'role' => User::ROLE_ADMIN,
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $api, $new_user);
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
        $api = $this->base_api;
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $api, $new_user);
        $response->assertStatus(201);

        $user = $response->json();
        $this->assertEquals($user['username'], $new_user['username']);
        $this->assertEquals($user['email'], $new_user['email']);
        $this->assertEquals($user['role'], User::ROLE_DINAS);
    }

    public function testAddUserFailedUsernameAlreadyTaken()
    {
        $api = $this->base_api;
        $new_user = [
            'username' => 'admin',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USERNAME_ALREADY_TAKEN');
    }

    public function testAddUserFailedMissingUsername()
    {
        $api = $this->base_api;
        $new_user = [
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USER_MISSING_USERNAME');
    }

    public function testAddUserFailedMissingPassword()
    {
        $api = $this->base_api;
        $new_user = [
            'username' => 'usertest',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USER_MISSING_PASSWORD');
    }

    public function testAddUserFailedMissingEmail()
    {
        $api = $this->base_api;
        $new_user = [
            'username' => 'admin',
            'password' => 'randompass',
        ];

        $response = $this->actingAs($this->admin_user)->json('POST', $api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USER_MISSING_EMAIL');
    }

    public function testAddUserAsPemprovUserFailed()
    {
        $api = $this->base_api;
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->pemprov_user)->json('POST', $api, $new_user);
        $response->assertStatus(401);

        $err = $response->json();
        $this->assertEquals($err['code'], 'NOT_AUTHORIZED');
    }

    public function testAddUserAsDinasUserFailed()
    {
        $api = $this->base_api;
        $new_user = [
            'username' => 'usertest',
            'password' => 'randompass',
            'email' => 'email@example.com',
        ];

        $response = $this->actingAs($this->dinas_user)->json('POST', $api, $new_user);
        $response->assertStatus(401);

        $err = $response->json();
        $this->assertEquals($err['code'], 'NOT_AUTHORIZED');
    }

    public function testUpdateUserSuccess()
    {
        $api = $this->base_api . '1';
        $new_user = [
            'username' => 'admin1',
            'password' => 'passadmin1',
            'email' => 'admin1@gmail.com',
            'role' => User::ROLE_DINAS,
        ];

        $response = $this->actingAs($this->admin_user)->json('PATCH', $api, $new_user);
        $response->assertStatus(200);

        $user = User::find(1);
        $retrieved_user = $response->json();
        $this->assertEquals($retrieved_user['username'], $new_user['username']);
        $this->assertEquals($retrieved_user['email'], $new_user['email']);
        $this->assertEquals($retrieved_user['role'], $new_user['role']);
        $this->assertTrue(Auth::attempt([
            'username' => $new_user['username'],
            'password' => $new_user['password'],
        ]));
        $this->assertEquals($user->username, $new_user['username']);
        $this->assertEquals($user->email, $new_user['email']);
        $this->assertEquals($user->role, $new_user['role']);
    }

    public function testUpdateUserFailedNotAuthorized()
    {
        $api = $this->base_api . '1';
        $new_user = [
            'username' => 'admin1',
            'password' => 'passadmin1',
            'email' => 'admin1@gmail.com',
            'role' => User::ROLE_DINAS,
        ];

        $response = $this->actingAs($this->pemprov_user)->json('PATCH', $api, $new_user);
        $response->assertStatus(401);

        $err = $response->json();
        $this->assertEquals($err['code'], 'NOT_AUTHORIZED');
    }

    public function testUpdateUserFailedNotFound()
    {
        $api = $this->base_api . '170845';
        $new_user = [
            'username' => 'admin1',
            'password' => 'passadmin1',
            'email' => 'admin1@gmail.com',
            'role' => User::ROLE_DINAS,
        ];

        $response = $this->actingAs($this->admin_user)->json('PATCH', $api, $new_user);
        $response->assertStatus(404);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USER_NOT_FOUND');
    }

    public function testUpdateUserFailedUsernameTaken()
    {
        $api = $this->base_api . '1';
        $new_user = [
            'username' => 'dinas',
            'password' => 'passadmin1',
            'email' => 'admin1@gmail.com',
            'role' => User::ROLE_DINAS,
        ];

        $response = $this->actingAs($this->admin_user)->json('PATCH', $api, $new_user);
        $response->assertStatus(400);

        $err = $response->json();
        $this->assertEquals($err['code'], 'USERNAME_ALREADY_TAKEN');
    }

    public function testUpdateUserSuccessOnlyRole()
    {
        $api = $this->base_api . '1';
        $new_user = [
            'role' => User::ROLE_DINAS,
        ];
        $user = User::find(1);

        $response = $this->actingAs($this->admin_user)->json('PATCH', $api, $new_user);
        $response->assertStatus(200);

        $retrieved_user = $response->json();
        $this->assertEquals($retrieved_user['username'], $user->username);
        $this->assertEquals($retrieved_user['email'], $user->email);
        $this->assertEquals($retrieved_user['role'], $new_user['role']);
    }

    public function testUpdateUserSuccessSameUsername()
    {
        $api = $this->base_api . '1';
        $new_user = [
            'username' => 'admin',
            'password' => 'passadmin1',
            'email' => 'admin1@gmail.com',
            'role' => User::ROLE_DINAS,
        ];

        $response = $this->actingAs($this->admin_user)->json('PATCH', $api, $new_user);
        $response->assertStatus(200);

        $retrieved_user = $response->json();
        $this->assertEquals($retrieved_user['username'], $new_user['username']);
    }
}
