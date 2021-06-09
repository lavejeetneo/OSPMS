<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOxygenCylindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oxygen_cylinders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->integer('5_ltr_qty')->default(5);
            $table->integer('10_ltr_qty')->default(5);
            $table->integer('15_ltr_qty')->default(5);
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
        Schema::dropIfExists('oxygen_cylinders');
    }
}
