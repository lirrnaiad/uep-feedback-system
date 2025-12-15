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
        // Create feedback_entries table
        Schema::create('feedback_entries', function (Blueprint $table) {
            $table->id();
            $table->string('unit_office');
            $table->date('transaction_date');
            $table->string('client_name')->nullable();
            $table->string('client_type'); // Citizen, Business, Internal, External
            $table->enum('sex', ['Male', 'Female']);
            $table->integer('age');
            $table->string('region');
            $table->string('service_availed');
            $table->string('email')->nullable();
            // Citizen's Charter answers
            $table->tinyInteger('cc1_awareness'); // 1 to 4
            $table->tinyInteger('cc2_visibility')->nullable(); // 1 to 4, or 0 for N/A
            $table->tinyInteger('cc3_helpfulness')->nullable(); // 1 to 4, or 0 for N/A
            $table->text('suggestions')->nullable();
            $table->timestamps();
        });

        // Create questions table
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('code'); // e.g., "SQD1", "SQD2"
            $table->text('text'); // The question text
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Create responses table
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_entry_id')->constrained('feedback_entries')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->tinyInteger('score'); // 1 (Strongly Disagree) to 5 (Strongly Agree), or 0 (N/A)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('feedback_entries');
    }
};
