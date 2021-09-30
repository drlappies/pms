<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('todo', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable(true);
            $table->longText('desc')->nullable(false);
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
        Schema::dropIfExists('todo');
    }
}
