<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthsTable extends Migration
{

    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->id();
            $table->integer('month');
            $table->string('monthName');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('months');
    }
}
