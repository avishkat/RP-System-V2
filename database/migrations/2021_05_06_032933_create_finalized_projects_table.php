<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalizedProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalized_projects', function (Blueprint $table) {
            $table->id();
            $table->string('projectid');
            $table->string('topic');
            $table->string('area');
            $table->string('supervisor');
            $table->string('cosupervisor');
            $table->string('groupid');
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
        Schema::dropIfExists('finalized_projects');
    }
}
