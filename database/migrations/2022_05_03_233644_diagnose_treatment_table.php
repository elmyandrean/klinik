<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiagnoseTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('diagnose_treatment', function (Blueprint $table) {
        $table->id();
        $table->foreignId('diagnose_id')->nullable()->references('id')->on('diagnoses');
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
      Schema::dropIfExists('diagnose_treatment');
    }
}
