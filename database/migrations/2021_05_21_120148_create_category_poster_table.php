<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPosterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_poster', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('category_poster');
    }
}
