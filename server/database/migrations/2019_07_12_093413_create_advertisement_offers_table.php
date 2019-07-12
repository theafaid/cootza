<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provided_to');
            $table->text('content');
            $table->unsignedBigInteger('provided_by');
            $table->boolean('swap_approved')->default(false);
            $table->timestamps();

            $table->foreign('provided_by')->references('id')
                ->on('users')->onDelete('cascade');

            $table->foreign('provided_to')->references('id')
                ->on('advertisements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisement_offers');
    }
}
