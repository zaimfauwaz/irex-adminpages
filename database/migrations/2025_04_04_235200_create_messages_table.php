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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('message_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('session_id')->references('chat_session_id')->on('chat_sessions')->onDelete('cascade');
            $table->foreign('employee_id')->references('employee_id')->on('users')->onDelete('cascade');
            $table->string('sender');
            $table->text('message');
            $table->boolean('is_bot')->default(true);
            $table->boolean('is_escalated')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['session_id']);
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('messages');
    }
};
