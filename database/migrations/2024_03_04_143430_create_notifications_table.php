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
        Schema::create('notifications', function (Blueprint $table) {
            $table->string('id',30)->primary();
            $table->string('title');
            $table->string('subject');
            $table->string('body')->nullable();
            $table->string('notification_type_id')->nullable();
            $table->string('author_id');
            $table->string('employee_id')->nullable();
            $table->boolean('is_open')->default(false);
            $table->string('priority_order_id')->nullable();
            $table->string('status_id')->default('sta-1007');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
