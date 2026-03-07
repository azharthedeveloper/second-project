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
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->after('description');
            $table->enum('post_type', ['article', 'news', 'blog', 'tutorial', 'Facebook', 'Instagram', 'TikTok', 'Thread', 'Twitter', 'Linkedin'])->default('article')->after('status');
            $table->bigInteger('views')->unsigned()->default(0)->after('post_type');
            $table->integer('likes')->unsigned()->default(0)->after('views');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['status', 'post_type', 'views', 'likes']);
        });
    }
};
