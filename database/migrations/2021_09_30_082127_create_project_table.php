<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('user');
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
        Schema::dropIfExists('project');
    }
}
