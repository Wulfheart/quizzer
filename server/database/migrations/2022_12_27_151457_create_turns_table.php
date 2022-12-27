<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('question_id')->constrained('questions');
            $table->integer('question_selected_answer_player_1')->nullable();
            $table->dateTime('question_timeout_player_1')->nullable();
            $table->dateTime('question_selected_answer_at_player_1')->nullable();
            $table->integer('question_selected_answer_player_2')->nullable();
            $table->dateTime('question_timeout_player_2')->nullable();
            $table->dateTime('question_selected_answer_at_player_2')->nullable();
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
        Schema::dropIfExists('turns');
    }
};
