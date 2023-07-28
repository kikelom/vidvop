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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->unsignedBigInteger('user_id');
            $table->string('producer')->nullable();
            $table->string('genre')->nullable();
            $table->string('age_rating')->nullable();
            $table->timestamp('upload_date');
            $table->timestamps();

            // Define foreign key constraint for publisher_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint first to avoid issues
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Drop the table
        Schema::dropIfExists('videos');
    }
};
