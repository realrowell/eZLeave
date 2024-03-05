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
        Schema::create('employee_positions', function (Blueprint $table) {
            $table->string('id',16)->primary();
            $table->string('employee_id',20)->nullable();
            $table->string('position_id',12); 
            $table->string('area_of_assignment_id',16);
            $table->string('reports_to_id',50)->nullable();
            $table->string('second_superior_id',50)->nullable();
            $table->string('status_id',8)->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_positions');
    }
};
