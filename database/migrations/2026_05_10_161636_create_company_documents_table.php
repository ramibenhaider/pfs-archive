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
        Schema::create('company_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')
                  ->nullable()
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->foreignId('company_document_type_id')
                  ->nullable()
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->string('file_path')->nullable();
            $table->string('comment', 100)->nullable();
            $table->timestamps();
            $table->string('original_name', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_documents');
    }
};
