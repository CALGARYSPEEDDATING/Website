<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuestionsToDatingProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dating_profiles', function (Blueprint $table) {
            $table->text('question_one')->nullable();
            $table->text('question_two')->nullable();
            $table->text('question_three')->nullable();
            $table->text('question_four')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dating_profiles', function (Blueprint $table) {
            //
        });
    }
}
