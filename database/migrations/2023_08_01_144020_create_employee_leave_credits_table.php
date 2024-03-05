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
        Schema::create('employee_leave_credits', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('leave_type_id',12);
            $table->string('employee_id',20);
            $table->decimal('leave_days_credit',4,2);
            $table->string('status_id',8)->default('sta-1007');
            $table->string('fiscal_start_year',100)->nullable();
            $table->string('fiscal_end_year',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_leave_credits');
    }
};
