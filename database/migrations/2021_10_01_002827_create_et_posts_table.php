<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('et_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stats_id');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('visibility',24)->default('all');
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->index('user_id');
            $table->index('stats_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('et_posts');
    }
}
