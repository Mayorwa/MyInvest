<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('estateId');
            $table->integer('companyId');
            $table->integer('noOfPlots');
            $table->double('amount');
            $table->enum('type',['land','property'])->default('land');
            $table->text('rules');
            $table->text('description');
            $table->string('slug')->unique();
            $table->boolean('isAvailable')->default(true);
            $table->boolean('isActive')->default(true);
            $table->boolean('isDeleted')->default(false);
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
        Schema::dropIfExists('properties');
    }
}
