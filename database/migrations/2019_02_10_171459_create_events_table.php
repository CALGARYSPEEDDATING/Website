<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('address');
            $table->string('slug');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->decimal('price_male', 6, 2);
            $table->decimal('price_female', 6, 2);
            $table->text('tags')->nullable();
            $table->integer('status')->default(0);
            $table->integer('type')->default(0);
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            $table->integer('limit')->default(0);
            $table->integer('payment_method')->default(0);
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
        Schema::dropIfExists('events');
    }
}
