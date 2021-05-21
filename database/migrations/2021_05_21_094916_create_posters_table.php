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
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);



            $table->integer('comments_quantity');
            $table->integer('likes_quantity');
            $table->boolean('is_liked');
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
