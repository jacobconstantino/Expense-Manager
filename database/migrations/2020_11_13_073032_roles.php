<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('displayname');
            $table->string('description');
            $table->timestamp('created_at')->useCurrent();
        });

        DB::table('roles')->insert(
        array(
            'displayname' => 'Administrator',
            'description' => 'Super Admin'
        )
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
