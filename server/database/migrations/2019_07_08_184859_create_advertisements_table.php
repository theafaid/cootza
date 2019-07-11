<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('category_id');
            // preferable_swap_with contains id of the category which user wants to swap with
            $table->unsignedSmallInteger('preferably_swap_with')->nullable();

            // Delete the ad if creator deleted
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            // Set preferable_swap_with to null when remove the preferable category
            $table->foreign('preferably_swap_with')->references('id')
                ->on('categories')->onDelete('SET NULL');

            // Delete the ad if it's category deleted
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
