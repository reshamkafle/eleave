<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekDaysTable extends Migration
{

    public function up()
    {
        Schema::create('week_days', function (Blueprint $table) {
            $table->id();
            $table->integer('dayValue');
            $table->string('dayName');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('week_days');
    }
}
