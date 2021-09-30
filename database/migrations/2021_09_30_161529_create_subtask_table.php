<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtaskTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('subtask', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id')->nullable(false);
            $table->foreign('task_id')->references('id')->on('task');
            $table->string('title', 100)->nullable(false);
            $table->string('desc')->nullable(true);
            $table->datetime('start_datetime')->nullable(true);
            $table->datetime('due_datetime')->nullable(true);
            $table->enum('priority', ['unspecified', 'low', 'normal', 'high', 'urgent'])->default('unspecified');
            $table->enum('status', ['open', 'on_progress', 'stuck', 'resolved'])->default('open');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('subtask');
    }
}
