<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingDaysTable extends Migration
{
        
    public function up()
    {
        Schema::create('working_days', function (Blueprint $table) {
            $table->id();
            $table->integer('day');
            $table->boolean('fullDay')->default(0);
            $table->foreignId('company_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('working_days');
    }
}
