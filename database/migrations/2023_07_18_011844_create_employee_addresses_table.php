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
        Schema::create('employee_addresses', function (Blueprint $table) {
            $table->string('id',16)->primary();
            $table->string('address_line_1',100);
            $table->string('city',50);
            $table->string('province',50);
            $table->string('region',50);
            $table->string('status_id',8)->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_addresses');
    }
};
