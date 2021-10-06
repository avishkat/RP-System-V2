<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_groups', function (Blueprint $table) {
            $table->id();
            $table->string('groupid');
            $table->string('member1');
            $table->string('reg1');
            $table->string('phone1');
            $table->string('email1');
            $table->string('spec1');
            $table->string('gpa1');
            $table->string('image1');
            $table->string('member2');
            $table->string('reg2');
            $table->string('phone2');
            $table->string('email2');
            $table->string('spec2');
            $table->string('gpa2');
            $table->string('image2');
            $table->string('member3');
            $table->string('reg3');
            $table->string('phone3');
            $table->string('email3');
            $table->string('spec3');
            $table->string('gpa3');
            $table->string('image3');
            $table->string('member4');
            $table->string('reg4');
            $table->string('phone4');
            $table->string('email4');
            $table->string('spec4');
            $table->string('gpa4');
            $table->string('image4');
            $table->string('status');
            $table->string('researchid');
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
        Schema::dropIfExists('research_groups');
    }
}
