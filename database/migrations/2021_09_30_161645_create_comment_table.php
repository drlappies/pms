<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('user');
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('task');
            $table->unsignedBigInteger('tagged_user_id')->nullable(true);
            $table->foreign('tagged_user_id')->references('id')->on('user');
            $table->unsignedBigInteger('tagged_subtask_id')->nullable(true);
            $table->foreign('tagged_subtask_id')->references('id')->on('subtask');
            $table->string('comment')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('comment');
    }
}
