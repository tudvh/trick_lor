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
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->unsignedInteger('author_id');
            $table->string('youtube_id', 50)->nullable();
            $table->text('description')->nullable();
            $table->text('thumbnails')->nullable();
            $table->text('thumbnails_custom')->nullable();
            $table->unsignedSmallInteger('status')->default(1)->comment('1: Waiting | 2: Public | 3: Private | 4: Blocked');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
