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
        Schema::create('fiscal_years', function (Blueprint $table) {
            $table->string('id',8)->primary();
            $table->string('fiscal_year_title',100);
            $table->string('fiscal_year_description')->nullable();
            $table->date('fiscal_year_start');
            $table->date('fiscal_year_end');
            $table->string('status_id',8)->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_years');
    }
};
