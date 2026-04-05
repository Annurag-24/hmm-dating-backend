<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds 'type' column to track like/dislike:
     * - type = 1: liked
     * - type = 0: disliked
     */
    public function up(): void
    {
        Schema::table('like_profiles', function (Blueprint $table) {
            $table->tinyInteger('type')->default(1)->after('user_id')
                ->comment('1 = liked, 0 = disliked');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('like_profiles', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
