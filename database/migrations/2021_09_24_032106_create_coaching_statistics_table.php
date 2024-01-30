<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coaching_id');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('dislikes')->default(0);
            $table->bigInteger('enrollments')->default(0);
            $table->bigInteger('shares')->default(0);
            $table->bigInteger('compares')->default(0);
            $table->double('average_rating',1)->default(0);
            $table->timestamps();

            $table->index('coaching_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coaching_statistics');
    }
}
