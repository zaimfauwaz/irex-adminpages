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
        Schema::create('faqlists', function (Blueprint $table) {
            $table->id('faq_id');
            $table->string('faq_question', 383);
            $table->text('faq_answer');
            $table->string('faq_category', 255);
            $table->boolean('faq_status');
            $table->json('faq_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqlists');
    }
};
