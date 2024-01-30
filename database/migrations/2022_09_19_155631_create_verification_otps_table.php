<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_otps', function (Blueprint $table) {
            $table->id();
            $table->string('phone',10);
            $table->string('otp',4);
            $table->enum('type',['cdlogin','etlogin','cdregister','etregister','applogin','appregister'])->default('cdlogin');
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
        Schema::dropIfExists('verification_otps');
    }
}
