<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('size');
            $table->integer('companyId');
            $table->integer('noOfPlots');
            $table->integer('noOfSoldPlots');
            $table->double('amount');
            $table->text('bio');
            $table->text('additionalFees');
            $table->text('address');
            $table->string('state');
            $table->string('country');
            $table->text('rules');
            $table->text('description');
            $table->string('slug')->unique();
            $table->boolean('isActive')->default(true);
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
        Schema::dropIfExists('estates');
    }
}
