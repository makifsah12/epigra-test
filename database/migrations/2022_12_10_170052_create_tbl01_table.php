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
        Schema::create('tbl:01', function (Blueprint $table) {
            $table->string('capsule_serial');
            $table->string('capsule_id');
            $table->string('status');
            $table->dateTime('original_launch')->nullable();
            $table->bigInteger('original_launch_unix')->nullable();
            $table->string('missions')->nullable();
            $table->integer('landings')->nullable();
            $table->string('type')->nullable();
            $table->string('details')->nullable();
            $table->integer('reuse_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl01');
    }
};
