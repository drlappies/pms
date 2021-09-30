<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateOrgTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('org', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false); // user owner id
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 100)->nullable(false);
            $table->string('address', 100)->nullable(false);
            $table->string('number', 50)->nullable(false);
            $table->string('email_address', 320)->nullable(false);
            $table->longText('desc')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('org');
    }
}
