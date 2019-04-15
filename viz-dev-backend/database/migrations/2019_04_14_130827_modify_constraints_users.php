<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyConstraintsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vizdev_users', function (Blueprint $table) {
            $table->string('email', 50)->change();
            $table->string('username', 50)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vizdev_users', function (Blueprint $table) {
            $table->string('email')->unique()->change();
            $table->string('username')->change();
        });
    }
}
