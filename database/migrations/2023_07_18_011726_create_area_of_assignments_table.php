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
        Schema::create('area_of_assignments', function (Blueprint $table) {
            $table->string('id',16)->primary();
            $table->string('location_address',100);
            $table->string('location_desc',300);
            $table->string('embedded_google_map',1000)->nullable()->default('Not available');
            $table->string('status_id',8)->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_of_assignments');
    }
};
