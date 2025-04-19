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
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->bigIncrements('chat_session_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->string('chat_subject');
            $table->string('chat_type', 31)->nullable();
            $table->integer('chat_priority');
            $table->boolean('chat_status');
            $table->string('chat_summary', 4095)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_sessions', function (Blueprint $table) {
            $table->dropForeign(['customer_id']); // Drop foreign key constraint
        });
        Schema::dropIfExists('chat_sessions');
    }
};
