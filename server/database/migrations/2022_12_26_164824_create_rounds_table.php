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
        Schema::create('rounds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('game_id')->constrained();
            $table->foreignUuid('category_id')->constrained();
            $table->foreignUuid('question_1_id')->constrained('questions');
            $table->integer('question_1_selected_answer_player_1')->nullable();
            $table->integer('question_1_selected_answer_player_2')->nullable();
            $table->foreignUuid('question_2_id')->constrained('questions');
            $table->integer('question_2_selected_answer_player_1')->nullable();
            $table->integer('question_2_selected_answer_player_2')->nullable();
            $table->foreignUuid('question_3_id')->constrained('questions');
            $table->integer('question_3_selected_answer_player_1')->nullable();
            $table->integer('question_3_selected_answer_player_2')->nullable();
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
        Schema::dropIfExists('rounds');
    }
};
