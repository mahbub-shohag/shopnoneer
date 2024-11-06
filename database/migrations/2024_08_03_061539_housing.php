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
        Schema::create('housings', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->foreignId('division_id')->constrained('divisions');
           $table->foreignId('district_id')->constrained('districts');
           $table->foreignId('upazila_id')->constrained('upazilas');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
