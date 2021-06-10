<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLeaveApplicationDocumentsTable extends Migration
{
    
    public function up()
    {
        Schema::create('leave_application_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mime');
            $table->foreignId('leave_application_id')->constrained();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE leave_application_documents ADD file  MEDIUMBLOB");
    }

    public function down()
    {
        Schema::dropIfExists('leave_application_documents');
    }
}
