<?php

namespace Tests\Unit;

use App\Models\User;
use App\Http\Controllers\SeriesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    private $admin_user = null;

    public function setUp() : void
    {
        parent::setUp();
        $this->admin_user = User::where('role', User::ROLE_ADMIN)->first();
    }

    public function testToJson()
    {
        $user_json = json_decode($this->admin_user->toJson());
        $this->assertEquals($user_json->id, $this->admin_user->id);
        $this->assertEquals($user_json->username, $this->admin_user->username);
        $this->assertEquals($user_json->email, $this->admin_user->email);
        $this->assertEquals($user_json->role, $this->admin_user->role);
        $this->assertObjectNotHasAttribute('password', $user_json);
        $this->assertObjectNotHasAttribute('created_at', $user_json);
        $this->assertObjectNotHasAttribute('updated_at', $user_json);
    }
}
