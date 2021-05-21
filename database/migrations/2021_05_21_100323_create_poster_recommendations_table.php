<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosterRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');

            $table->bigInteger('poster_id');
            $table->foreign('poster_id')->references('id')->on('posters');

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
        Schema::dropIfExists('poster_recommendations');
    }
}
