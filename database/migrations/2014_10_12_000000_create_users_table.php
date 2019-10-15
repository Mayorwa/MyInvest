<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->date('dob');
            $table->longText('address');
            $table->string('slug', 10);
            $table->string('avatar')->nullable();
            $table->enum('type', ['user', 'admin', 'realtor', 'consultant','company'])->default('user');
            $table->string('nextOfKin');
            $table->string('nextOfKinPhone')->unique();
            $table->string('nextOfKinEmail')->unique();
            $table->boolean('isDeleted')->default(false);
            $table->boolean('isActive')->default(false);
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
        Schema::dropIfExists('users');
    }
}
