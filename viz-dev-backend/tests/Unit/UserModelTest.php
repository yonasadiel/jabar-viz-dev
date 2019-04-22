<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

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

    public function testCanModifyUser()
    {
        $this->assertTrue($this->admin_user->can_modify_users());
        $this->assertFalse($this->pemprov_user->can_modify_users());
        $this->assertFalse($this->dinas_user->can_modify_users());
    }
}
