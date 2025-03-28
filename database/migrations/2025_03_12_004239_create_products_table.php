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
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('RSkuKey')->primary();
            $table->string('RSkuNo', 31)->unique();
            $table->string('RUom', 7);
            $table->string('RSkuName1', 255);
            $table->string('RSkuName2', 31)->nullable();
            $table->integer('RSkuMoq');
            $table->string('RSkuPr', 127);
            $table->string('RSkuPrName', 127);
            $table->string('RSkuBrn', 127);
            $table->string('RSkuBrnName', 127);
            $table->double('RSkuPrice');
            $table->integer('RQoh')->default(0);
            $table->string('RSkuType', 63);
            $table->json('RSkuAttributes')->nullable();
            $table->json('RSkuTags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
