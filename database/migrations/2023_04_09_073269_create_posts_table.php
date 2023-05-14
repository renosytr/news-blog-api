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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('writter_id')->constrained('writters')->onDelete('restrict');
            $table->text('title');
            $table->longtext('post_content');
            $table->text('summary');
            $table->text('slug');
            $table->string('cover')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->string('tags')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
