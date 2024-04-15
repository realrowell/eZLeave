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
        Schema::create('leave_credit_approvals', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('employee_leave_credit_id');
            $table->string('leave_type_id',12);
            $table->decimal('leave_days',5,2);
            $table->string('employee_id',20);
            $table->string('author_id',20);
            $table->string('approver_id',20)->nullable();
            $table->string('fiscal_year_id');
            $table->string('reason_note',500)->nullable();
            $table->string('status_id',8)->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_credit_approvals');
    }
};
