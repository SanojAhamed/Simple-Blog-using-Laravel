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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->after('id'); // Add title column
            $table->text('content')->nullable()->after('title'); // Add content column, nullable
            $table->string('featured_image')->nullable()->after('content'); // Add featured_image column, nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['title', 'content', 'post_image']);
        });
    }
};
