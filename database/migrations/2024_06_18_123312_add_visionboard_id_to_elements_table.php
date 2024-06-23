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
        Schema::table('elements', function (Blueprint $table) {
          if (!Schema::hasColumn('elements', 'visionboard_id')) {
            $table->foreignId('visionboard_id')->constrained()->onDelete('cascade');
        }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elements', function (Blueprint $table) {
        $table->dropForeign(['visionboard_id']);
        $table->dropColumn('visionboard_id');
        });
    }
};
