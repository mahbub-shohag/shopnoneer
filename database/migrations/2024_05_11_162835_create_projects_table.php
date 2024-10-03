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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->foreignId('division_id')->constrained('divisions');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('upazila_id')->constrained('upazilas');
            $table->foreignId('housing_id')->constrained('housings');
            $table->string('road')->nullable();
            $table->string('block')->nullable();
            $table->string('plot')->nullable();
            $table->float('plot_size')->nullable();
            $table->string('plot_face')->nullable();
            $table->boolean('is_corner')->nullable();
            $table->integer('storied')->nullable();
            $table->integer('no_of_units')->nullable();
            $table->integer('floor_area')->nullable();
            $table->integer('floor_no')->nullable();
            $table->integer('no_of_beds')->nullable();
            $table->integer('no_of_baths')->nullable();
            $table->integer('no_of_balcony')->nullable();
            $table->boolean('parking_available')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_phone')->nullable();
            $table->string('owner_email')->nullable();
            $table->integer('rate_per_sqft')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('description')->nullable();
            $table->string('google_map')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
