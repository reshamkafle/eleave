<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    
    
public function up()
{
    Schema::create('leave_applications', function (Blueprint $table) {
        $table->id();
        $table->date('startDate');
        $table->date('endDate');
        $table->string('name');
        $table->boolean('fullDay')->default(1);
        $table->integer('noOfDayApplied');
        $table->integer('noOfWorkingDay');
        $table->integer('noOfPublicHoliday');
        $table->integer('noOfDayDeduct');
        $table->integer('leaveStatus')->default(0);;
        $table->foreignId('user_id')->constrained();
        $table->foreignId('leave_type_id')->constrained();
        $table->boolean('needCertificate')->default(0);
        $table->softDeletes();       
        $table->timestamps();
    });
}
public function down()
{
    Schema::dropIfExists('leave_applications');
}
}
