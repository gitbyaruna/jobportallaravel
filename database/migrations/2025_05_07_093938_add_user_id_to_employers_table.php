<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToEmployersTable extends Migration
{
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();  // Add user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Add foreign key constraint
        });
    }

    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);  // Drop foreign key constraint
            $table->dropColumn('user_id');  // Drop the user_id column
        });
    }
}
