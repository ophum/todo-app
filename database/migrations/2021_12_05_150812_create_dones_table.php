<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_id');
            $table->boolean('is_done');
            $table->timestamps();

            $table->foreign('todo_id')->references('id')->on('todos')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dones');
    }
}
