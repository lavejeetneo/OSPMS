<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('gender', 20);
            $table->tinyInteger('age');
            $table->bigInteger('addar_number');
            $table->text('id_proof');
            $table->boolean('is_covid_positve');
            $table->date('covid_positive_date')->nullable();
            $table->text('address');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('phone');
            $table->string('cylinder_type');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
