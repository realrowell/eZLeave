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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->string('id',12)->primary();
            $table->string('leave_type_title',50);
            $table->string('leave_type_description',300)->nullable();
            $table->decimal('leave_days_per_year',65,2);
            $table->decimal('max_leave_days',5,2);
            $table->dateTime('reset_date')->nullable();
            $table->dateTime('cut_off_date')->nullable();
            $table->boolean('show_on_employee')->default(false);
            $table->boolean('accumulable')->default(false);
            $table->boolean('predate')->default(false);
            $table->string('status_id',8)->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
