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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_post_id')->unsigned();
            $table->foreign('job_post_id')->references('id')->on('job_posts');
            $table->bigInteger('applicant_id')->unsigned();
            $table->foreign('applicant_id')->references('id')->on('users');
            $table->text('cover_letter');
            $table->string('status')->default('pending'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
