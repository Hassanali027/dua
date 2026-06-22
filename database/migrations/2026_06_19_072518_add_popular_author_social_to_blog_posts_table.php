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
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->boolean('is_popular')->default(0)->after('status');
            $table->string('author_image')->nullable()->after('author_name');
            $table->string('facebook_link')->nullable()->after('long_description');
            $table->string('twitter_link')->nullable()->after('facebook_link');
            $table->string('instagram_link')->nullable()->after('twitter_link');
            $table->string('youtube_link')->nullable()->after('instagram_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn([
                'is_popular',
                'author_image',
                'facebook_link',
                'twitter_link',
                'instagram_link',
                'youtube_link'
            ]);
        });
    }
};
