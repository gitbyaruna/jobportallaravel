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
        Schema::table('candidates', function (Blueprint $table) {
            // First drop the foreign key constraint
            $table->dropForeign(['job_post_id']);

            // Then drop the column
            $table->dropColumn('job_post_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Recreate the column
            $table->unsignedBigInteger('job_post_id')->nullable();

            // Recreate the foreign key
            $table->foreign('job_post_id')->references('id')->on('job_posts')->onDelete('cascade');
        });
    }
};
