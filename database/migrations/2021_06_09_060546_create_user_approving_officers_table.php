<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserApprovingOfficersTable extends Migration
{
    
    public function up()
    {
        Schema::create('user_approving_officers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('approving_id')->constrained('users');
            $table->timestamps();
        });

    }
    public function down()
    {
        Schema::dropIfExists('user_approving_officers');
    }
}
