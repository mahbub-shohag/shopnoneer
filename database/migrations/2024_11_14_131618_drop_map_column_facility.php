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
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn('google_map_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->string('google_map_url')->nullable()->change();
    }
};
