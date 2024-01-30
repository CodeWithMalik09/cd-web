<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coaching_id');
            $table->string('section')->nullable();
            $table->text('review');
            $table->integer('stars_faculties');
            $table->integer('stars_fees');
            $table->integer('stars_study_materials');
            $table->integer('stars_results');
            $table->decimal('overall_rating',1)->default(0.0);
            $table->string('image')->nullable();
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('dislikes')->default(0);
            $table->timestamps();

            $table->index('user_id');
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
        Schema::dropIfExists('reviews');
    }
}
