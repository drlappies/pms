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
            $table->unsignedBigInteger('author_id')->nullable(false);
            $table->foreign('author_id')->references('id')->on('user');
            $table->unsignedBigInteger('todo_id')->nullable(false);
            $table->foreign('todo_id')->references('id')->on('todo');
            $table->unsignedBigInteger('todo_tagged_id')->nullable(false);
            $table->foreign('todo_tagged_id')->references('id')->on('todo');
            $table->unsignedBigInteger('user_tagged_id')->nullable(false);
            $table->foreign('user_tagged_id')->references('id')->on('user');
            $table->string('body')->nullable(false);
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
