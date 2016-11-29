<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePddAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdd_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pdd_question_id')->unsigned();
            $table->foreign('pdd_question_id')
                ->references('id')
                ->on('pdd_questions')
                ->onDelete('cascade');
            $table->integer('number')->unsigned();
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
        Schema::dropIfExists('pdd_answers');
    }
}
