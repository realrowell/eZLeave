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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id',25)->primary();
            $table->string('first_name',50);
            $table->string('middle_name',50)->nullable();
            $table->string('last_name',50);
            $table->string('suffix_id',8)->nullable();
            $table->string('user_name',50)->unique();
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role_id',8)->default('rol-0003');
            $table->string('status_id',8)->default('sta-2001');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
