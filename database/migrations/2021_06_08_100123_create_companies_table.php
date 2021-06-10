<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('city')->nullable();
            $table->string('telephone')->unique();
            $table->string('fax')->nullable();
            $table->string('emailAddress')->unique();
            $table->timestamps();
            $table->foreignId('country_id')->constrained();
            $table->softDeletes();

        });
    }
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
