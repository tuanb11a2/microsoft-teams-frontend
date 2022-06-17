<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained();
            $table->string('title');
            $table->text('description')->nullable();
            $table->datetime('deadline');
            $table->integer('grade')->max(100)->nullable();
            $table->datetime('submitted_at')->nullable();
            $table->text('content');
            $table->enum('status', ['assigned', 'finished', 'overdue', 'closed']);
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
        Schema::dropIfExists('exercises');
    }
}
