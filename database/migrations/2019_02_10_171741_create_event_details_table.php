<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            // $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('event_id')
                    ->references('id')->on('events')
                    ->onDelete('cascade');
            $table->integer('male_age_to')->default(0);
            $table->integer('male_age_from')->default(0);
            $table->integer('female_age_to')->default(0);
            $table->integer('female_age_from')->default(0);
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
        Schema::dropIfExists('event_details');
    }
}
