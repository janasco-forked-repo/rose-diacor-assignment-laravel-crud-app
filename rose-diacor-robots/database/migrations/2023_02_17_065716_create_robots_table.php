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
        Schema::create('robots', function (Blueprint $table) {
            $table->id();
            $table->string('robot_name');
            $table->string('robot_desc');
            $table->string('robot_creator');
            $table->string('robot_country');
            $table->string('robot_year');
            $table->string('robot_type');
            $table->string('robot_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robots');
    }
};
