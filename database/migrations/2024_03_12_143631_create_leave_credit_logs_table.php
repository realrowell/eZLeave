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
        Schema::create('leave_credit_logs', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('employee_leave_credits_id',20);
            $table->string('leave_application_rn')->nullable();
            $table->string('leave_approval_id')->nullable();
            $table->decimal('leave_days_credit',5,2);
            $table->string('status_id',8)->default('sta-1007');
            $table->string('reason_note',500)->nullable();
            $table->string('employee_id',256);
            $table->string('fiscal_year_id',256);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_credit_logs');
    }
};
