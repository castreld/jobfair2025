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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('applicant_id')->unique();

            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address');

            $table->string('school_name'); 
            $table->string('major');
            $table->year('graduation_year');
            $table->string('last_education');

            $table->text('skills');
            $table->string('portfolio_link')->nullable();
            $table->string('portfolio_file_path')->nullable();
            $table->text('personal_summary');

            $table->string('photo_path');
            $table->string('cv_path');
            $table->string('zip_path'); 

            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};