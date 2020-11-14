<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('Name');
            $table->string('Email');
            $table->string('password');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('created_at')->useCurrent();
        });

        DB::table('Users')->insert(
        array(
            'name' => 'Administrator',
            'email' => 'admin@yahoo.com',
            'password' =>'admin',
            'role_id' => 1
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
        Schema::dropIfExists('Users');
    }
}
