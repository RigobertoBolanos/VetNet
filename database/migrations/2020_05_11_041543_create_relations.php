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
        Schema::table('medical_histories', function ($table) {
            $table->foreign('pet')->references('id')->on('pets');
        });

        Schema::table('medical_records', function ($table) {
            $table->foreign('veterinary')->references('id')->on('users');
            $table->foreign('medical_history')->references('id')->on('medical_histories');
        });

        Schema::table('appointments', function ($table) {
            $table->foreign('veterinary')->references('id')->on('users');
            $table->foreign('pet')->references('id')->on('pets');
            $table->foreign('service')->references('id')->on('services');
        });

        Schema::table('pets', function ($table) {
            $table->foreign('owner')->references('id')->on('users');            
            $table->foreign('medical_history')->references('id')->on('medical_histories');
        });

        //Schema::table('medical_histories', function ($table) {
        //    $table->foreign('pet')->references('id')->on('pets');
        //});
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
