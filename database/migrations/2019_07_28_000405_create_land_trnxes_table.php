<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandTrnxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landtrnxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('itemId');
            $table->integer('userId');
            $table->string('cycle');
            $table->string('cycleCompleted');
            $table->date('nextPayment')->nullable();
            $table->string('slug')->unique();
            $table->boolean('isCompleted')->default(false);
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
        Schema::dropIfExists('landTrnxes');
    }
}
