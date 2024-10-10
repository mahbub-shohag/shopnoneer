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
        Schema::table('projects', function (Blueprint $table) {
            // Check if the column does not exist before adding it
            if (!Schema::hasColumn('projects', 'project_image')) {
                $table->string('project_image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the column if it exists
            if (Schema::hasColumn('projects', 'project_image')) {
                $table->dropColumn('project_image');
            }
        });
    }
};
