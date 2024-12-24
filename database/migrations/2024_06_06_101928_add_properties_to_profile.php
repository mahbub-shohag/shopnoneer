<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('fullName')->nullable();
            $table->string('religion')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('presentDivision')->nullable();
            $table->string('presentDistrict')->nullable();
            $table->string('presentUpazilla')->nullable();
            $table->string('presentCity')->nullable();
            $table->string('permanentDivision')->nullable();
            $table->string('permanentDistrict')->nullable();
            $table->string('permanentUpazilla')->nullable();
            $table->string('permanentCity')->nullable();
            $table->string('preferableDivision')->nullable();
            $table->string('preferableDistrict')->nullable();
            $table->string('preferableUpazilla')->nullable();
            $table->string('preferableCity')->nullable();
            $table->integer('estimatedBudget')->unsigned()->nullable();
            $table->integer('preferableFlatSize')->unsigned()->nullable();
            $table->integer('monthlyIncome')->unsigned()->nullable();
            $table->integer('currentCapital')->unsigned()->nullable();
            $table->integer('totalFamilyMembers')->unsigned()->nullable();
            $table->string('sourceOfIncome')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            Schema::dropIfExists('daily_service_materials');
        });
    }
};
