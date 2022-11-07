<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewproposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviewproposal', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('venue');
            $table->string('date');
            $table->string('stime');
            $table->string('etime');
            $table->string('address')->nullable();
            $table->string('platform')->nullable();
            $table->string('link')->nullable();
            $table->string('duration')->nullable();
            $table->multiLineString('notes')->nullable();
            $table->integer('jv_id');
            $table->integer('jp_id');
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
        Schema::dropIfExists('interviewproposal');
    }
}
