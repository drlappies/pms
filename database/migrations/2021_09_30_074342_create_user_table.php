<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('email_address', 320)->nullable(false);
            $table->string('firstname', 100)->nullable(false);
            $table->string('lastname', 100)->nullable(false);
            $table->string('is_employee')->default(false);
            $table->string('icon_url')->nullable(true);
            $table->string('icon_key')->nullable(true);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user');
    }
}
