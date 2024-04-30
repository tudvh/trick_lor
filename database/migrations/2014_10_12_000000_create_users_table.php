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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 100);
            $table->string('avatar', 100)->nullable();
            $table->string('avatar_public_id', 100)->nullable();
            $table->string('email', 100);
            $table->string('username', 100);
            $table->text('password');
            $table->unsignedSmallInteger('role')->default(2)->comment('1: Admin | 2: User');
            $table->string('google_id', 50)->nullable();
            $table->unsignedSmallInteger('status')->default(1)->comment('1: Registered | 2: Verified | 3: Blocked');
            $table->string('verification_token', 100)->nullable();
            $table->datetime('last_email_sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
