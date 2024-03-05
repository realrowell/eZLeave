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
        Schema::create('sub_departments', function (Blueprint $table) {
            $table->string('id',12)->primary();
            $table->string('sub_department_title',50);
            $table->string('department_id',8);
            $table->string('status_id',8)->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_departments');
    }
};
