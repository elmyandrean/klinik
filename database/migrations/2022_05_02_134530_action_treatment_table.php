<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActionTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('action_treatment', function (Blueprint $table) {
        $table->id();
        $table->foreignId('action_id')->nullable()->references('id')->on('actions');
        $table->foreignId('treatment_id')->nullable()->references('id')->on('treatments');
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
      Schema::dropIfExists('action_treatment');
    }
}
