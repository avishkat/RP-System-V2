<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project__bids', function (Blueprint $table) {
            $table->id();
            $table->string('researchid');
            $table->string('groupid');
            $table->string('supervisor');
            $table->string('area');
            $table->string('preference');
            $table->string('qualifications');
            $table->string('comments')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('project__bids');
    }
}
