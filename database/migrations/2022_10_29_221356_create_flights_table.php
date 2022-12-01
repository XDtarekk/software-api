<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('destination');
            $table->string('departON');
            $table->string('returnOn');
            $table->string('seatClass');
            $table->string('numberOfStops');
            $table->string('RorO');
            $table->integer('numberOfTickets');
            $table->string('price');
            $table->string('image');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
