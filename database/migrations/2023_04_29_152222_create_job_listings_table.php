<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->integer('employer_id');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('salary', 8, 2);
            $table->text('job_type');
            $table->text('requirements');
            $table->dateTime('deadline');
            $table->text('education');
            $table->text('yrOfexp');
            $table->text('eligibility');
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
        Schema::dropIfExists('job_listings');
    }
}
