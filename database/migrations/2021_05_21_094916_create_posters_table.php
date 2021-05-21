<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->integer('price');
            $table->integer('site');
            $table->string('date');
            $table->string('description');
            $table->string('address');
            $table->string('phones');
            $table->string('latitude');
            $table->string('longitude');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('gallery_poster_id')->references('id')->on('gallery_posters');
            $table->integer('comments_quantity');
            $table->integer('likes_quantity');
            $table->foreign('poster_recommendations_table')->references('id')->on('poster_recommendations');
            $table->string('is_liked');
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
        Schema::dropIfExists('posters');
    }
}
