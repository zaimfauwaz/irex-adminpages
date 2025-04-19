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
        Schema::create('playgroundinquiries', function (Blueprint $table) {
            $table->id('inquiry_id');
            $table->foreignId('playground_id')->constrained('playgrounds', 'playground_id')->onDelete('cascade');
            $table->text('prompt');
            $table->text('result');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playgroundinquiries');
    }
};
