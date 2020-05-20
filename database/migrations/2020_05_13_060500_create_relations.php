<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pets', function ($table) {
            $table->foreign('owner')->references('id')->on('users');
            $table->foreign('medicalhistory')->references('id')->on('medical_histories');
        });

        Schema::table('medical_records', function ($table) {
            $table->foreign('veterinary')->references('id')->on('users');
            $table->foreign('medicalhistory')->references('id')->on('medical_histories');
        });

        Schema::table('medical_histories', function ($table) {
            $table->foreign('pet')->references('id')->on('pets');
        });

        Schema::table('appointments', function ($table) {
            $table->foreign('pet')->references('id')->on('pets');
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->foreign('service')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_histories');
    }
}
