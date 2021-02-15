<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('authorized')->default(true);
            $table->string('password');
            $table->foreignId('role')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('boutique')->nullable();
            $table->rememberToken();
        });

        \Illuminate\Support\Facades\DB::table('users')->insert( array(
            ['name' => 'admin', 'email' => 'admin@admin.com', 'password' => 'admin', 'role' => 1],
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
