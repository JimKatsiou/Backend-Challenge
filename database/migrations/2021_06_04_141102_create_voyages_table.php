<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->increments('vessel_id');
            $table->foreign('vessel_id')->references('id')->on('vessels');
            $table->string('code');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('status');
            $table->decimal('revenues',8,2);
            $table->decimal('expenses',8,2);
            $table->decimal('profit',8,2);
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
        Schema::dropIfExists('voyages');
    }
}
