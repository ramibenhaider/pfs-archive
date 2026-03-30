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
            $table->id();
            $table->string('id_number', 10)
                  ->nullable()
                  ->unique();
            $table->date('expiry_date_id')
                  ->nullable();
            $table->foreignId('management_id')
                  ->constrained('management')
                  ->nullable();
            $table->foreignId('nationality_id')
                  ->constrained('nationalities')
                  ->nullable();
            $table->string('name')
                  ->nullable();
            $table->string('job_number')
                  ->nullable()
                  ->unique();
            $table->string('phone_number', 10)
                  ->nullable()
                  ->unique();
            $table->string('passport_number')
                  ->nullable()
                  ->unique();
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
