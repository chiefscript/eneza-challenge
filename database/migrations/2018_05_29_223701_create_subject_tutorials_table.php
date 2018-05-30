<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_tutorials', function (Blueprint $table) {
            $table->integer('subject_id');
            $table->integer('tutorial_id');
            $table->nullableTimestamps();

            $table->primary(['subject_id', 'tutorial_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_tutorials');
    }
}
