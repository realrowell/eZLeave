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
        Schema::create('positions', function (Blueprint $table) {
            $table->string('id',12)->primary();
            $table->string('position_title_id');
            $table->string('position_description',300)->nullable();
            $table->string('subdepartment_id');
            $table->string('position_level_id',8)->nullable();
            $table->string('status_id',8)->default('sta-1007');
            $table->boolean('is_hr_manager')->nullable();
            $table->boolean('is_hod')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
