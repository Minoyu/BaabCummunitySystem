<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsDrawerOpenToUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_info', function (Blueprint $table) {
            //
            $table->boolean('is_drawer_open')->nullable()->comment("PC是否默认开启抽屉");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_info', function (Blueprint $table) {
            //
        });
    }
}
