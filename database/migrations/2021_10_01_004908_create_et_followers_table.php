<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('et_followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id');
            $table->unsignedBigInteger('following_id');
            $table->timestamps();

            $table->index('follower_id');
            $table->index('following_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('et_followers');
    }
}
