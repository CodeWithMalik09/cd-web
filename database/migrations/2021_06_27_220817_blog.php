<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Blog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('category',['job','blog'])->default('blog');
            $table->string('course')->nullable();
            $table->string('slug',512);
            $table->text('heading');
            $table->text('content');
            $table->string('thumbnail');
            $table->unsignedBigInteger('views')->default(1);
            $table->timestamps();

            $table->index('user_id');
            $table->index('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
