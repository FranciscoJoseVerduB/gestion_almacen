<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_triggers', function (Blueprint $table) {
            $table->id();
            $table->string('tabla');
            $table->unsignedBigInteger('id_tabla');
            $table->string('operacion');
            $table->string('mensaje');
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
        Schema::dropIfExists('log_triggers');
    }
}
