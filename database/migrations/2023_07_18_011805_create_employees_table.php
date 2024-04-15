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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('user_id',25)->unique();
            $table->string('sap_id_number')->nullable();
            $table->string('contact_number',20)->nullable();
            $table->string('address_id',16)->nullable();
            $table->string('employee_position_id',16)->nullable();
            $table->date('birthdate');
            $table->string('gender_id',8);
            $table->string('marital_status_id',8);
            $table->string('status_id',8)->default('sta-2001');
            $table->string('employment_status_id',8);
            $table->date('date_hired')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
