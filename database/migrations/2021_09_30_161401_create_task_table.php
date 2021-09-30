<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable(false);
            $table->foreign('project_id')->references('id')->on('project');
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
        Schema::dropIfExists('task');
    }
}
