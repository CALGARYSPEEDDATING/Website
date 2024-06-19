<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatingProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dating_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('profile')->nullable();
            $table->integer('gender')->default(2)->unsigned();
            $table->string('a_phone')->nullable();
            $table->text('matches_info')->nullable();
            $table->text('about_us')->nullable();
            $table->tinyInteger('newsletter')->default(0)->unsigned();
            $table->tinyInteger('subscribed')->default(0)->unsigned();

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
        Schema::dropIfExists('dating_profiles');
    }
}
