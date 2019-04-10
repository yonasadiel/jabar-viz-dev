<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vizdev_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->enum('role', [User::ROLE_DINAS, User::ROLE_ADMIN, User::ROLE_PEMPROV])->default(User::ROLE_DINAS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vizdev_users');
    }
}
