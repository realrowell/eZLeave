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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->string('id',25)->primary();
            $table->string('reference_number',20)->unique();
            $table->string('leave_type_id');
            $table->dateTime('start_date');
            $table->string('start_part_of_day')->default('dprt-1001'); // morning or afternoon
            $table->dateTime('end_date');
            $table->string('end_part_of_day')->default('dprt-1001'); // morning or afternoon
            $table->decimal('duration',5,2);
            $table->string('attachment')->nullable();
            $table->string('employee_id');
            $table->string('approver_id')->nullable();
            $table->string('second_approver_id')->nullable();
            $table->string('employee_leave_credit_id');
            $table->string('fiscal_year_id')->nullable();
            $table->string('status_id')->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
