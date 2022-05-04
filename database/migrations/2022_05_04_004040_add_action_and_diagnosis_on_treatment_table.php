<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActionAndDiagnosisOnTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatments', function (Blueprint $table) {
          $table->dropColumn(['treatment', 'diagnosis']);

          $table->foreignId('action_id')->nullable()->after('id')->references('id')->on('actions');    
          $table->foreignId('diagnose_id')->nullable()->after('action_id')->references('id')->on('diagnoses');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropForeign(['action_id']);
            $table->dropForeign(['diagnose_id']);
            $table->dropColumn(['action_id', 'diagnose_id']);

            $table->string('treatment')->after('id');
            $table->string('diagnosis')->nullable()->after('treatment');
        });
    }
}
