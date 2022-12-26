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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('description')->default('-');
            $table->string('status', 25);
            $table->time('time_needed');
            $table->date('done_date')->nullable();
            $table->foreignId('assigner_id')->constrained('users')->comment('project manager id');
            $table->foreignId('assignee_id')->constrained('users')->comment('assignee id');
            $table->foreignId('project_id')->constrained('projects');
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
        Schema::dropIfExists('tasks');
    }
};
