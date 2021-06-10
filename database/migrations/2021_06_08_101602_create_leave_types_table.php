<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name');
            $table->integer('cycleMonth');
            $table->boolean('allowNegativeApplication')->default(0);
            $table->boolean('needCertificate')->default(0);
            $table->foreignId('company_id')->constrained();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
}
