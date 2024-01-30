<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtPostStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('et_post_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('shares')->default(0);
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
        Schema::dropIfExists('et_post_stats');
    }
}
