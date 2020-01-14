<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateVotersListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_voters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('candidate_id')->index();
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->unsignedInteger('voter_id')->index();
            $table->foreign('voter_id')->references('id')->on('voters_list')->onDelete('cascade');
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
        Schema::dropIfExists('candidate_voters');
    }
}
