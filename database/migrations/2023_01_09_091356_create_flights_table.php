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
            $table->enum('direction', ['outbound', 'inbound'])->index();
            $table->string('flight_number')->unique()->index();
            $table->string('dep_airport', 3)->index();
            $table->string('arv_airport', 3)->index();
            $table->time('dep_time');
            $table->time('arv_time');
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
        Schema::dropIfExists('flights');
    }
};
