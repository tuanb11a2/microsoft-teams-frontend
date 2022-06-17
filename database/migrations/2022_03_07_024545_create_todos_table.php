<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->datetime('deadline');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->enum('type', ['Backlog', 'In progress', 'Review', 'Finished']);
            $table->enum('priority', ['High', 'Low', 'Medium']);
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
        Schema::dropIfExists('todos');
    }
}
